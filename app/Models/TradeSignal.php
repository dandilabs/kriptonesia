<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TradeSignal extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'symbol', 'type', 'entry_price', 'target_price', 'stop_loss', 'analysis', 'description', 'image', 'user_id', 'expired_at', 'trade_type', 'leverage'];

    protected $casts = [
        'entry_price' => 'decimal:8',
        'target_price' => 'decimal:8',
        'stop_loss' => 'decimal:8',
        'expired_at' => 'datetime',
        'leverage' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('expired_at', '>', now());
    }

    public function scopeSpot($query)
    {
        return $query->where('trade_type', 'spot');
    }

    public function scopeFuture($query)
    {
        return $query->where('trade_type', 'future');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
