<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Ambil rate USDT terbaru
        try {
            $response = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=tether&vs_currencies=idr');
            $data = json_decode($response, true);
            $rate = $data['tether']['idr'] ?? 16500;
        } catch (\Exception $e) {
            $rate = 16500; // Fallback default rate
        }

        // Kosongkan tabel product
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $products = [
            // Paket News
            [
                'name' => 'News 1 Bulan',
                'type' => 'news',
                'code' => 'news_1bulan',
                'duration_months' => 1,
                'price' => 50000,
                'description' => 'Akses berita premium selama 1 bulan',
                'features' => ['Berita harian eksklusif', 'Analisis pasar mendalam', 'Prediksi harga kripto', 'Update real-time 24/7', 'Akses ke newsletter premium'],
            ],
            [
                'name' => 'News 3 Bulan',
                'type' => 'news',
                'code' => 'news_3bulan',
                'duration_months' => 3,
                'price' => 120000,
                'description' => 'Akses berita premium selama 3 bulan dengan diskon',
                'features' => ['Semua fitur 1 bulan', 'Diskon 20% dari harga bulanan', 'Laporan mingguan eksklusif', 'Prioritas customer support'],
            ],
            [
                'name' => 'News 6 Bulan',
                'type' => 'news',
                'code' => 'news_6bulan',
                'duration_months' => 6,
                'price' => 200000,
                'description' => 'Akses berita premium selama 6 bulan dengan diskon besar',
                'features' => ['Semua fitur 3 bulan', 'Diskon 33% dari harga bulanan', 'Akses ke webinar bulanan', 'Laporan analisis khusus'],
            ],

            // Paket Membership
            [
                'name' => 'Membership 3 Bulan',
                'type' => 'membership',
                'code' => 'membership_3bulan',
                'duration_months' => 3,
                'price' => 500000,
                'description' => 'Akses penuh semua fitur selama 3 bulan',
                'features' => ['Semua fitur News Premium', 'Sinyal trading eksklusif', 'Portofolio management tools', 'Komunitas private member', 'Weekly coaching session'],
            ],
            [
                'name' => 'Membership 6 Bulan',
                'type' => 'membership',
                'code' => 'membership_6bulan',
                'duration_months' => 6,
                'price' => 1500000,
                'description' => 'Akses penuh semua fitur selama 6 bulan dengan diskon',
                'features' => ['Semua fitur 3 bulan', 'Diskon 16% dari harga bulanan', '1-on-1 konsultasi bulanan', 'Early access ke fitur baru', 'Undangan event eksklusif'],
            ],
            [
                'name' => 'Membership Lifetime',
                'type' => 'membership',
                'code' => 'membership_lifetime',
                'duration_months' => null,
                'price' => 3000000,
                'description' => 'Akses seumur hidup ke semua fitur premium',
                'features' => ['Akses permanen ke semua fitur', 'Free update selamanya', 'VIP customer support', 'Exclusive merchandise', 'Kesempatan jadi beta tester'],
            ],
        ];

        foreach ($products as $product) {
            $product['price_usd'] = round($product['price'] / $rate, 2); // hitung otomatis
            $product['features'] = json_encode($product['features']);
            $product['is_active'] = true;
            $product['created_at'] = now();
            $product['updated_at'] = now();

            Product::create($product);
        }

        $this->command->info('Successfully seeded products table with current USD rate (Rp ' . number_format($rate) . ')');
    }
}
