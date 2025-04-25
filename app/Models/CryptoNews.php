<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CryptoNews extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'url', // Tambahkan ini
        'source',
        'source_icon',
        'published_at',
        'votes',
        'currencies',
        'image_url'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'currencies' => 'array'
    ];
}
