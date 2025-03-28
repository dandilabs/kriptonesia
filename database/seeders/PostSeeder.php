<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'judul' => 'Apa Itu 3? Panduan Lengkap untuk Pemula',
                'slug' => 'apa-itu-3-panduan-lengkap-untuk-pemula',
                'category_id' => 2, // Panduan Pemula 📖
                'content' => '3 adalah mata uang digital terdesentralisasi pertama yang diciptakan oleh Satoshi Nakamoto. Artikel ini menjelaskan cara kerja, sejarah, dan cara membeli 3.',
                'views' => 1500,
                'image' => '3-guide.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'users_id' => 1, // ID user yang membuat post
                'tags' => ['3', '9', '1'],
            ],
            [
                'judul' => 'Cara Aman Menyimpan Crypto di Wallet',
                'slug' => 'cara-aman-menyimpan-crypto-di-wallet',
                'category_id' => 3, // Keamanan Crypto 🔒
                'content' => 'Simak panduan memilih wallet crypto (hot vs cold wallet) dan tips keamanan untuk menghindari peretasan.',
                'views' => 3200,
                'image' => 'crypto-wallet-security.jpg',
                'created_at' => now()->subDays(5),
                'updated_at' => now(),
                'deleted_at' => null,
                'users_id' => 2,
                'tags' => ['6', '8', '10'],
            ],
            [
                'judul' => 'Analisis Pasar: Prediksi Harga 4 Tahun 2024',
                'slug' => 'analisis-pasar-prediksi-harga-4-tahun-2024',
                'category_id' => 6, // Analisis Pasar 📈
                'content' => 'Bagaimana prospek 4 pasca-upgrade Shanghai? Berikut analisis faktor teknis dan fundamental yang memengaruhi harganya.',
                'views' => 4500,
                'image' => 'eth-price-prediction.jpg',
                'created_at' => now()->subDays(10),
                'updated_at' => now(),
                'deleted_at' => null,
                'users_id' => 1,
                'tags' => ['4', '5', '7'],
            ],
            [
                'judul' => '5 Strategi DCA (Dollar-Cost Averaging) untuk Crypto',
                'slug' => '5-strategi-dca-untuk-crypto',
                'category_id' => 4, // Strategi Dasar Trading 📈
                'content' => 'DCA adalah metode investasi crypto yang mengurangi risiko volatilitas. Pelajari cara menerapkannya dengan optimal.',
                'views' => 2800,
                'image' => 'dca-strategy.jpg',
                'created_at' => now()->subDays(15),
                'updated_at' => now(),
                'deleted_at' => null,
                'users_id' => 3,
                'tags' => ['5', '10', '7'],
            ],
            [
                'judul' => 'NFT 101: Memahami Konsep dan Potensinya',
                'slug' => 'nft-101-memahami-konsep-dan-potensinya',
                'category_id' => 7, // Altcoin & NFT 🎨
                'content' => 'Apa itu NFT? Bagaimana cara membeli dan menjualnya? Temukan jawabannya di panduan komprehensif ini.',
                'views' => 3900,
                'image' => 'nft-guide.jpg',
                'created_at' => now()->subDays(20),
                'updated_at' => now(),
                'deleted_at' => null,
                'users_id' => 2,
                'tags' => ['2', '4', '9'],
            ],
            [
                'judul' => 'Update: Regulasi Crypto di Indonesia Terbaru 2024',
                'slug' => 'regulasi-crypto-indonesia-2024',
                'category_id' => 5, // Berita & Update 📰
                'content' => 'Peraturan Bappebti tentang pajak crypto dan batasan transaksi. Bagaimana dampaknya bagi investor?',
                'views' => 5100,
                'image' => 'crypto-regulation.jpg',
                'created_at' => now()->subDays(3),
                'updated_at' => now(),
                'deleted_at' => null,
                'users_id' => 1,
                'tags' => ['1', '10', '1'],
            ],
            [
                'judul' => 'Review 5 Aplikasi Crypto Terbaik untuk Pemula',
                'slug' => 'review-aplikasi-crypto-terbaik-untuk-pemula',
                'category_id' => 8, // Review & Rekomendasi 🟢
                'content' => 'Bandingkan fitur Binance, Pintu, Tokocrypto, dan lainnya. Mana yang paling user-friendly?',
                'views' => 2200,
                'image' => 'crypto-apps-review.jpg',
                'created_at' => now()->subDays(7),
                'updated_at' => now(),
                'deleted_at' => null,
                'users_id' => 3,
                'tags' => ['1', '9', '10'],
            ],
            [
                'judul' => '2 Explained: Teknologi di Balik Crypto',
                'slug' => '2-explained-teknologi-di-balik-crypto',
                'category_id' => 1, // Dasar-Dasar Crypto 🟢
                'content' => 'Bagaimana 2 bekerja? Apa bedanya dengan database tradisional? Simak penjelasan sederhananya.',
                'views' => 1800,
                'image' => '2-basics.jpg',
                'created_at' => now()->subDays(12),
                'updated_at' => now(),
                'deleted_at' => null,
                'users_id' => 2,
                'tags' => ['2', '1', '9'],
            ],
            [
                'judul' => 'Cara Mendeteksi Scam Crypto dan Penipuan',
                'slug' => 'cara-mendeteksi-scam-crypto-dan-penipuan',
                'category_id' => 3, // Keamanan Crypto 🔒
                'content' => 'Kenali tanda-tanda proyek crypto palsu, phishing, dan skema Ponzi untuk melindungi aset Anda.',
                'views' => 4100,
                'image' => 'crypto-scam-alert.jpg',
                'created_at' => now()->subDays(9),
                'updated_at' => now(),
                'deleted_at' => null,
                'users_id' => 1,
                'tags' => ['8', '10', '7'],
            ],
            [
                'judul' => 'Memahami Gas Fee 4 dan Cara Menghematnya',
                'slug' => 'memahami-gas-fee-4-dan-cara-menghematnya',
                'category_id' => 1, // Dasar-Dasar Crypto 🟢
                'content' => 'Apa itu Gas Fee? Kapan waktu terbaik untuk bertransaksi di 4? Berikut tipsnya.',
                'views' => 2900,
                'image' => 'eth-gas-fee.jpg',
                'created_at' => now()->subDays(18),
                'updated_at' => now(),
                'deleted_at' => null,
                'users_id' => 3,
                'tags' => ['4', '2', '10'],
            ],
        ];

        foreach ($posts as $postData) {
            $post = Post::create([
                'judul' => $postData['judul'],
                'slug' => $postData['slug'],
                'category_id' => $postData['category_id'],
                'content' => $postData['content'],
                'views' => $postData['views'],
                'image' => $postData['image'],
                'users_id' => $postData['users_id'],
            ]);

            // Attach tags (jika menggunakan relasi many-to-many)
            if (isset($postData['tags'])) {
                $post->tags()->attach($postData['tags']);
            }
        }
    }
}
