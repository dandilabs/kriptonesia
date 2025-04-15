<?php

namespace App\Console\Commands;

use App\Models\FearGreedIndex;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateFearGreedIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-fear-greed-index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Fear and Greed Index data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://api.alternative.me/fng/');
        $data = $response->json();

        FearGreedIndex::create([
            'value' => $data['data'][0]['value'],
            'label' => $data['data'][0]['value_classification'],
            'timestamp' => now()
        ]);

        $this->info('Fear and Greed Index updated successfully!');
    }
}
