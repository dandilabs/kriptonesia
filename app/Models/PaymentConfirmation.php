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
        'status',
        'created_at' // Tambahkan ini
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
