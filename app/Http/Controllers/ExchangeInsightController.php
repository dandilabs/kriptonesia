<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ExchangeInsightController extends Controller
{
    public function index()
    {
        $cryptos = Cache::remember('crypto_insights', 300, function () {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'User-Agent' => 'Laravel CryptoInsight App'
            ])->get('https://api.coingecko.com/api/v3/coins/markets', [
                'vs_currency' => 'usd',
                'order' => 'market_cap_desc',
                'per_page' => 100,
                'page' => 1,
                'sparkline' => false,
                'price_change_percentage' => '24h'
            ]);

            return $response->successful() ? $response->json() : [];
        });

        if (empty($cryptos)) {
            return back()->with('error', 'Failed to fetch cryptocurrency data. Please try again later.');
        }

        return view('membership.exchange.insight', [
            'topCoins' => collect($cryptos)->take(10),
            'topGainers' => collect($cryptos)
                ->sortByDesc('price_change_percentage_24h')
                ->take(5),
            'topLosers' => collect($cryptos)
                ->sortBy('price_change_percentage_24h')
                ->take(5),
            'topVolume' => collect($cryptos)
                ->sortByDesc('total_volume')
                ->take(5),
            'marketDominance' => $this->calculateMarketDominance($cryptos)
        ]);
    }

    public function show($id)
    {
        $coin = Cache::remember("coin_detail_{$id}", 3600, function() use ($id) {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'User-Agent' => 'Laravel CryptoInsight App'
            ])->get("https://api.coingecko.com/api/v3/coins/{$id}", [
                'localization' => false,
                'tickers' => false,
                'market_data' => true,
                'community_data' => true,
                'developer_data' => true,
                'sparkline' => false
            ]);

            return $response->successful() ? $response->json() : null;
        });

        if (!$coin) {
            abort(404, 'Cryptocurrency not found');
        }

        return view('membership.exchange.coin_detail', [
            'coin' => $coin,
            'marketData' => $this->formatMarketData($coin['market_data']),
            'priceChange' => $this->getPriceChangeData($coin['market_data']),
            'allTimeHigh' => $this->getAllTimeHighData($coin['market_data']),
            'supplyData' => $this->getSupplyData($coin['market_data']),
            'links' => $this->getLinksData($coin['links']),
            'developerData' => $this->getDeveloperData($coin['developer_data'] ?? null),
        ]);
    }

    // Helper methods...
    protected function calculateMarketDominance($cryptos)
    {
        $totalMarketCap = collect($cryptos)->sum('market_cap');

        return collect($cryptos)->take(5)->mapWithKeys(function($coin) use ($totalMarketCap) {
            return [
                $coin['symbol'] => round(($coin['market_cap'] / $totalMarketCap) * 100, 2)
            ];
        });
    }

    protected function formatMarketData($marketData)
    {
        return [
            'current_price' => [
                'usd' => number_format($marketData['current_price']['usd'], 2),
                'btc' => number_format($marketData['current_price']['btc'], 8),
            ],
            'market_cap' => [
                'usd' => number_format($marketData['market_cap']['usd'] / 1000000000, 2) . 'B',
                'btc' => number_format($marketData['market_cap']['btc'], 2),
            ],
            'volume' => number_format($marketData['total_volume']['usd'] / 1000000000, 2) . 'B',
            'price_change_percentage_24h' => number_format($marketData['price_change_percentage_24h'], 2),
        ];
    }

    protected function getPriceChangeData($marketData)
    {
        return [
            '24h' => [
                'change' => $marketData['price_change_24h'],
                'percentage' => $marketData['price_change_percentage_24h'],
            ],
            '7d' => [
                'change' => $marketData['price_change_percentage_7d_in_currency']['usd'],
                'percentage' => $marketData['price_change_percentage_7d'],
            ],
            '30d' => [
                'change' => $marketData['price_change_percentage_30d_in_currency']['usd'],
                'percentage' => $marketData['price_change_percentage_30d'],
            ],
        ];
    }

    protected function getAllTimeHighData($marketData)
    {
        return [
            'price' => number_format($marketData['ath']['usd'], 2),
            'date' => date('M j, Y', strtotime($marketData['ath_date']['usd'])),
            'percentage_down' => number_format($marketData['ath_change_percentage']['usd'], 2),
        ];
    }

    protected function getSupplyData($marketData)
    {
        return [
            'circulating' => number_format($marketData['circulating_supply'], 0),
            'total' => $marketData['total_supply'] ? number_format($marketData['total_supply'], 0) : '∞',
            'max' => $marketData['max_supply'] ? number_format($marketData['max_supply'], 0) : '∞',
        ];
    }

    protected function getLinksData($links)
    {
        return [
            'homepage' => array_filter($links['homepage']),
            'blockchain' => array_filter([
                $links['blockchain_site'][0] ?? null,
                $links['blockchain_site'][1] ?? null,
                $links['blockchain_site'][2] ?? null,
            ]),
            'social' => [
                'twitter' => $links['twitter_screen_name'] ? 'https://twitter.com/' . $links['twitter_screen_name'] : null,
                'facebook' => $links['facebook_username'] ? 'https://facebook.com/' . $links['facebook_username'] : null,
                'reddit' => $links['subreddit_url'] ?: null,
            ],
            'repos' => [
                'github' => array_filter($links['repos_url']['github']),
            ],
        ];
    }

    protected function getDeveloperData($devData)
    {
        if (!$devData) return null;

        return [
            'forks' => $devData['forks'],
            'stars' => $devData['stars'],
            'subscribers' => $devData['subscribers'],
            'total_issues' => $devData['total_issues'],
            'closed_issues' => $devData['closed_issues'],
            'pull_requests' => ($devData['pull_requests_merged'] ?? 0) + ($devData['pull_requests_closed'] ?? 0),
            'last_4_weeks' => [
                'commits' => $devData['last_4_weeks_commit_activity_series'] ?? [],
            ],
        ];
    }
}
