<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Cryptocurrency'],
            ['name' => 'Blockchain'],
            ['name' => 'Bitcoin'],
            ['name' => 'Ethereum'],
            ['name' => 'CryptoTrading'],
            ['name' => 'CryptoWallet'],
            ['name' => 'CryptoInvestment'],
            ['name' => 'KeamananCrypto'],
            ['name' => 'BelajarCrypto'],
            ['name' => 'TipsCrypto'],
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag['name'],
                'slug' => Str::slug($tag['name']), // Generate slug dari name
            ]);
        }
    }
}
