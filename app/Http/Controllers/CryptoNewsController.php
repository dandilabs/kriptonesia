<?php

namespace App\Http\Controllers;

use App\Models\CryptoNews;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CryptoNewsController extends Controller
{
    public function index()
    {
        $news = CryptoNews::latest('published_at')->paginate(12);

        return view('membership.crypto-news.index', [
            'news' => $news,
            'lastUpdated' => Cache::get('crypto_news_last_updated'),
        ]);
    }

    public function fetchLatest()
    {
        try {
            $response = Http::get('https://cryptopanic.com/api/v1/posts/', [
                'auth_token' => config('services.cryptopanic.api_key'),
                'currencies' => 'BTC',
                'kind' => 'news',
            ]);

            if (!$response->successful()) {
                throw new \Exception('Gagal terhubung ke API. Status: ' . $response->status());
            }

            $data = $response->json();

            // Tambahkan logging untuk debug
            Log::debug('CryptoPanic API Response Sample:', [
                'first_item' => $data['results'][0] ?? null,
                'media_structure' => $data['results'][0]['media'] ?? null,
            ]);

            if (empty($data['results'])) {
                throw new \Exception('Data dari API kosong');
            }

            $this->storeNews($data['results']);
            Cache::put('crypto_news_last_updated', now()->toDateTimeString(), now()->addHours(1));

            return back()->with('success', 'Berita Crypto berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    protected function storeNews(array $newsItems)
    {
        foreach ($newsItems as $item) {
            try {
                $publishedAt = isset($item['published_at']) ? date('Y-m-d H:i:s', strtotime($item['published_at'])) : now();

                Log::debug('Debug Image Extraction', [
                    'media_raw' => $item['media'] ?? null,
                    'resolved_image' => $this->getBestImage($item['media'] ?? []),
                    'title' => $item['title'] ?? '',
                ]);


                CryptoNews::updateOrCreate(
                    ['url' => $item['url']],
                    [
                        'title' => $item['title'] ?? 'No Title',
                        'summary' => $item['description'] ?? null,
                        'source' => $item['source']['title'] ?? null,
                        'source_icon' => $item['source']['icon'] ?? null,
                        'image_url' => $this->getBestImage($item['media'] ?? []), // Perbaikan di sini
                        'published_at' => $publishedAt,
                        'votes' => ($item['votes']['positive'] ?? 0) - ($item['votes']['negative'] ?? 0),
                        'currencies' => $item['currencies'] ?? [],
                    ],
                );
            } catch (\Exception $e) {
                Log::error('Error storing news item: ' . $e->getMessage(), ['item' => $item]);
                continue;
            }
        }
    }

    protected function getBestImage($media)
    {
        if (empty($media)) {
            return null;
        }

        // Jika media string langsung (kadang image langsung diberikan)
        if (is_string($media) && filter_var($media, FILTER_VALIDATE_URL)) {
            return $media;
        }

        // Jika array asosiatif tunggal
        if (is_array($media) && isset($media['url'])) {
            return $media['url'];
        }

        // Jika array berisi banyak item
        if (is_array($media)) {
            foreach ($media as $item) {
                if (isset($item['url']) && str_contains($item['url'], 'http')) {
                    return $item['url'];
                }
            }
        }

        return null;
    }
}
