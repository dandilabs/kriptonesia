<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\MembershipExpiredNotification;

class CheckExpiredMemberships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expired-memberships';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredUsers = User::where('payment_status', 'paid')
            ->whereNotNull('expired_at')
            ->where('expired_at', '<', now())
            ->get();

        foreach ($expiredUsers as $user) {
            $user->update([
                'payment_status' => 'expired',
                'membership_type' => 'free'
            ]);

            // Kirim notifikasi ke user
            $user->notify(new MembershipExpiredNotification());
            $this->info("Updated user {$user->id} ({$user->email}) to expired status");
        }

        $this->info("Total expired memberships updated: " . $expiredUsers->count());
        return 0;
    }
}
