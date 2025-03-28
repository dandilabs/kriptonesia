<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoNews extends Model
{
    protected $fillable = ['title','description','source','url','published_at','created_at','updated_at'];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
