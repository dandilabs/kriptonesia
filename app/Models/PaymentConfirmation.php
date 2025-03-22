<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentConfirmation extends Model
{
    protected $fillable = [
        'user_id',
        'payment_type',
        'amount',
        'proof',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
