<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\BitcoinNewsController;

class FetchBitcoinNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitcoin-news:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch latest Bitcoin news from LunarCrush API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controller = new BitcoinNewsController();
        $controller->fetchLatest();
        $this->info('Bitcoin news updated successfully!');
    }
}
