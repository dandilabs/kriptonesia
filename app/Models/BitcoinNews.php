<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitcoinNews extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'source',
        'url',
        'image_url',
        'published_at',
        'social_score'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];
}
