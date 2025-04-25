<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'is_active' => 'boolean',
        // 'is_popular' => 'boolean',
        'features' => 'array'
    ];

    protected $fillable = [
        'name', 'type', 'code', 'duration', 'price', 'price_usd',
        'description', 'features', 'is_active'
    ];

    // Accessor untuk tampilan durasi
    protected $appends = ['formatted_duration'];
    public function getFormattedDurationAttribute()
    {
        if (!$this->duration) {
            return 'Lifetime';
        }

        // Jika formatnya numeric (misal: 1, 3, 6, 12)
        if (is_numeric($this->duration)) {
            return $this->duration == 1 ? '1 Bulan' : $this->duration . ' Bulan';
        }

        // Jika sudah berupa string (misal: "3 Bulan", "Lifetime")
        return $this->duration;
    }

    // Mutator untuk menyimpan duration
    public function setDurationAttribute($value)
    {
        // Bersihkan nilai sebelum disimpan
        $this->attributes['duration'] = trim($value);
    }

    // Akses untuk features (jika disimpan sebagai JSON)
    public function getFeaturesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function setFeaturesAttribute($value)
    {
        $this->attributes['features'] = $value ? json_encode($value) : null;
    }
}
