<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradeSignal extends Model
{
    protected $fillable = ['name','content','image'];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
