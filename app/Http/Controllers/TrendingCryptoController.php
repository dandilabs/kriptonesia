<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TrendingCryptoController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get('https://api.coingecko.com/api/v3/search/trending');

            if (!$response->successful()) {
                throw new \Exception('Failed to fetch trending data');
            }

            $trending = $response->json()['coins'];

        } catch (\Exception $e) {
            Log::error('Trending API Error: ' . $e->getMessage());
            $trending = [];
            $error = $e->getMessage();
        }

        return view('membership.trending.index', [
            'trending' => $trending,
            'lastUpdated' => now()->format('Y-m-d H:i:s'),
            'error' => $error ?? null,
        ]);
    }

    private function processTrendingData(array $data): array
    {
        return [
            'coins' => $this->processCoins($data['coins'] ?? []),
            'categories' => $this->processCategories($data['categories'] ?? []),
        ];
    }

    private function processCoins(array $coins): array
    {
        $processed = [];

        foreach ($coins as $coin) {
            $item = $coin['item'] ?? [];
            $coinData = $item['data'] ?? [];
            $priceChange = $coinData['price_change_percentage_24h'] ?? [];

            $processed[] = [
                'id' => $this->ensureString($item['id'] ?? ''),
                'name' => $this->ensureString($item['name'] ?? 'N/A'),
                'symbol' => strtoupper($this->ensureString($item['symbol'] ?? '')),
                'price_btc' => $this->ensureFloat($item['price_btc'] ?? 0),
                'market_cap_rank' => $this->ensureInt($item['market_cap_rank'] ?? null),
                'thumb' => $this->ensureImageUrl($item['thumb'] ?? ''),
                'small' => $this->ensureImageUrl($item['small'] ?? ''),
                'large' => $this->ensureImageUrl($item['large'] ?? ''),
                'score' => $this->ensureFloat($item['score'] ?? 0),
                'price_change_percentage_24h' => $this->ensureFloat($priceChange['usd'] ?? 0),
            ];
        }

        // Sort by market cap rank
        usort($processed, function ($a, $b) {
            return ($a['market_cap_rank'] ?? PHP_INT_MAX) <=> ($b['market_cap_rank'] ?? PHP_INT_MAX);
        });

        return $processed;
    }

    private function processCategories(array $categories): array
    {
        $processed = [];

        foreach ($categories as $category) {
            $categoryData = $category['data'] ?? [];

            $processed[] = [
                'id' => $this->ensureString($category['id'] ?? ''),
                'name' => $this->ensureString($category['name'] ?? 'Unknown Category'),
                'market_cap' => $this->ensureFloat($categoryData['market_cap'] ?? 0),
                'market_cap_change_percentage_24h' => $this->ensureFloat($categoryData['market_cap_change_percentage_24h'] ?? 0),
            ];
        }

        return $processed;
    }

    private function ensureString($value): string
    {
        if (is_array($value)) {
            return json_encode($value);
        }
        return (string) ($value ?? '');
    }

    private function ensureFloat($value): float
    {
        if (is_array($value)) {
            return 0.0;
        }
        return (float) ($value ?? 0);
    }

    private function ensureInt($value): ?int
    {
        if (is_array($value) || is_null($value)) {
            return null;
        }
        return (int) $value;
    }

    private function ensureImageUrl($url): string
    {
        return filter_var($url, FILTER_VALIDATE_URL) ? $url : '';
    }
}
