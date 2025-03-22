<?php

namespace App\Observers;

use App\Models\User;
use App\Models\PaymentConfirmation;

class PaymentObserver
{
    /**
     * Handle the PaymentConfirmation "created" event.
     */
    public function created(PaymentConfirmation $paymentConfirmation): void
    {
        //
    }

    /**
     * Handle the PaymentConfirmation "updated" event.
     */
    public function updated(PaymentConfirmation $paymentConfirmation): void
    {
        if ($paymentConfirmation->status === 'paid') {
            User::where('id', $paymentConfirmation->user_id)->update(['payment_status' => 'paid']);
        }
    }

    /**
     * Handle the PaymentConfirmation "deleted" event.
     */
    public function deleted(PaymentConfirmation $paymentConfirmation): void
    {
        //
    }

    /**
     * Handle the PaymentConfirmation "restored" event.
     */
    public function restored(PaymentConfirmation $paymentConfirmation): void
    {
        //
    }

    /**
     * Handle the PaymentConfirmation "force deleted" event.
     */
    public function forceDeleted(PaymentConfirmation $paymentConfirmation): void
    {
        //
    }
}
