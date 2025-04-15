<?php

namespace App\Providers;

use GuzzleHttp\Client;
use App\Models\FearGreedIndex;
use Illuminate\Support\ServiceProvider;

class FearGreedService extends ServiceProvider
{
    protected $client;
    protected $apiUrl = 'https://api.alternative.me/fng/';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchFearGreedIndex()
    {
        try {
            $response = $this->client->get($this->apiUrl);
            $data = json_decode($response->getBody(), true);

            if (isset($data['data'][0])) {
                $indexData = $data['data'][0];

                return FearGreedIndex::updateOrCreate(
                    ['timestamp' => Carbon::createFromTimestamp($indexData['timestamp'])->toDateTimeString()],
                    [
                        'value' => $indexData['value'],
                        'value_classification' => $indexData['value_classification'],
                        'time_until_update' => $indexData['time_until_update'] ?? null,
                    ],
                );
            }

            return null;
        } catch (\Exception $e) {
            logger()->error('Error fetching Fear & Greed Index: ' . $e->getMessage());
            return null;
        }
    }

    public function getHistoricalData($days = 30)
    {
        try {
            $response = $this->client->get($this->apiUrl, [
                'query' => ['limit' => $days],
            ]);

            $data = json_decode($response->getBody(), true);

            return $data['data'] ?? [];
        } catch (\Exception $e) {
            logger()->error('Error fetching historical Fear & Greed data: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
