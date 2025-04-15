<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\PaymentConfirmation;
use Carbon\Carbon;

class CheckExpiredStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expired-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check & Update Expired Status User & Payment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // Update users
        User::where('expired_at', '<', $now)
            ->where('payment_status', '!=', 'expired')
            ->update(['payment_status' => 'expired']);

        // Update payment_confirmations
        PaymentConfirmation::where('expired_at', '<', $now)
            ->where('status', '!=', 'expired')
            ->update(['status' => 'expired']);

        $this->info('Status Expired Berhasil Diupdate!');
    }
}
