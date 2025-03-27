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
        'created_at', // Tambahkan ini
        'expired_at'
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_FAILED = 'failed';
    const STATUS_EXPIRED = 'expired';
    const STATUS_VERIFYING = 'verifying';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeLatestPerType($query)
    {
        return $query->whereIn('id', function($query) {
            $query->selectRaw('MAX(id)')
                ->from('payment_confirmations')
                ->groupBy('payment_type');
        });
    }
}
