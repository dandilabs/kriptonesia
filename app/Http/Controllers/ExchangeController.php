<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExchangeController extends Controller
{
    public function tickers($exchangeId = 'binance')
    {
        try {
            $response = Http::retry(3, 500)
                ->timeout(10)
                ->get("https://api.coingecko.com/api/v3/exchanges/{$exchangeId}/tickers", [
                    'include_exchange_logo' => 'true',
                    'page' => request('page', 1),
                ]);

            if (!$response->successful()) {
                throw new \Exception('API request failed with status: ' . $response->status());
            }

            $data = $response->json();
            $exchangeName = $data['name'] ?? ucfirst($exchangeId);
            $tickers = collect($data['tickers'] ?? []);

            // Process ticker data
            $processedTickers = $tickers->map(function ($ticker) {
                return [
                    'coin' => $ticker['base'],
                    'pair' => $ticker['target'],
                    'price' => $ticker['last'],
                    'volume' => $ticker['volume'],
                    'spread' => $ticker['bid_ask_spread_percentage'] ?? null,
                    'trust_score' => $ticker['trust_score'] ?? null,
                    'trade_url' => $ticker['trade_url'],
                    'last_traded_at' => $ticker['last_traded_at'],
                    'timestamp' => $ticker['timestamp'],
                ];
            });

            return view('membership.exchange.volume', [
                'exchangeName' => $exchangeName,
                'exchangeId' => $exchangeId,
                'tickers' => $processedTickers,
                'exchangeLogo' => $data['image'] ?? null,
                'currentPage' => request('page', 1),
                'lastUpdated' => now()->format('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            \Log::error('Exchange tickers error: ' . $e->getMessage());
            return view('membership.exchange.volume', [
                'exchangeName' => ucfirst($exchangeId),
                'exchangeId' => $exchangeId,
                'tickers' => collect(),
                'error' => 'Failed to load ticker data',
                'lastUpdated' => now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
