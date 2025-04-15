<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FearGreedIndex extends Model
{
    protected $fillable = ['value', 'label', 'timestamp'];
    protected $casts = [
        'timestamp' => 'datetime',
    ];
}
