<?php

namespace App\Http\Controllers;

use App\Models\BitcoinNews;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BitcoinNewsController extends Controller
{
    public function index()
    {
        $news = BitcoinNews::latest('published_at')->paginate(10);

        return view('membership.bitcoin-news.index', [
            'news' => $news,
            'lastUpdated' => Cache::get('bitcoin_news_last_updated'),
        ]);
    }

    public function fetchLatest()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.lunarcrush.api_key'),
            ])->get('https://lunarcrush.com/api4/public/category/bitcoin/news/v1');

            Log::debug('LunarCrush API Response:', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if ($response->status() === 402) {
                throw new \Exception('API Key tidak valid atau quota habis. Silakan periksa akun LunarCrush Anda.');
            }

            if (!$response->successful()) {
                throw new \Exception('Gagal terhubung ke API. Status: ' . $response->status());
            }

            $data = $response->json();

            if (empty($data['data'])) {
                throw new \Exception('Data dari API kosong. Response: ' . json_encode($data));
            }

            $this->storeNews($data['data']);
            Cache::put('bitcoin_news_last_updated', now()->toDateTimeString(), now()->addHours(1));

            return back()->with('success', 'Berita Bitcoin berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error fetching Bitcoin news: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    protected function storeNews(array $newsItems)
    {
        foreach ($newsItems as $item) {
            try {
                $publishedAt = isset($item['time_published']) ? date('Y-m-d H:i:s', strtotime($item['time_published'])) : now();

                BitcoinNews::updateOrCreate(
                    ['url' => $item['url']],
                    [
                        'title' => $item['title'] ?? 'No Title',
                        'excerpt' => $item['excerpt'] ?? substr($item['title'] ?? '', 0, 200),
                        'source' => $item['source'] ?? 'Unknown',
                        'image_url' => $item['image'] ?? null,
                        'published_at' => $publishedAt,
                        'social_score' => $item['social_score'] ?? 0,
                    ],
                );
            } catch (\Exception $e) {
                Log::error('Error storing news item: ' . $e->getMessage(), ['item' => $item]);
                continue;
            }
        }
    }
}
