<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\CssSelector\Node\FunctionNode;

class BlogController extends Controller
{
    public function index(Post $posts)
    {
        // Ambil 3 post terbaru
        $featured_posts = Post::latest()->take(3)->get();
        $categories = Category::with([
            'posts' => function ($query) {
                $query
                    ->with(['users', 'tags'])
                    ->latest()
                    ->take(3);
            },
        ])->get(); // Ambil semua kategori, meskipun tidak ada post

        $data = Post::latest()->paginate(5);
        $terbaru = Post::latest()->paginate(6);
        // Ambil 3 post dengan views tertinggi
        $popular_posts = Post::orderByDesc('views')->take(3)->get();

        // Ambil tag yang paling sering digunakan
        $popular_tags = Tag::withCount('posts')->orderByDesc('posts_count')->take(10)->get();

        // Ambil harga dari CoinGecko
        $cryptoPrices = Cache::remember('crypto_prices', 300, function () {
            try {
                $response = Http::get('https://api.coingecko.com/api/v3/simple/price', [
                    'ids' => 'bitcoin,ethereum,binancecoin,ripple,cardano,solana',
                    'vs_currencies' => 'usd',
                    'include_24hr_change' => 'true',
                ]);
                return $response->successful() ? $response->json() : [];
            } catch (\Exception $e) {
                Log::error('CoinGecko API Error: ' . $e->getMessage());
                return [];
            }
        });

        $cryptoList = [
            'bitcoin' => [
                'name' => 'Bitcoin',
                'image' => 'https://assets.coingecko.com/coins/images/1/large/bitcoin.png',
            ],
            'ethereum' => [
                'name' => 'Ethereum',
                'image' => 'https://assets.coingecko.com/coins/images/279/large/ethereum.png',
            ],
            'binancecoin' => [
                'name' => 'Binance Coin',
                'image' => 'https://assets.coingecko.com/coins/images/825/large/bnb-icon2_2x.png',
            ],
            'ripple' => [
                'name' => 'XRP',
                'image' => 'https://assets.coingecko.com/coins/images/44/large/xrp-symbol-white-128.png',
            ],
            'cardano' => [
                'name' => 'Cardano',
                'image' => 'https://assets.coingecko.com/coins/images/975/large/cardano.png',
            ],
            'solana' => [
                'name' => 'Solana',
                'image' => 'https://assets.coingecko.com/coins/images/4128/large/solana.png',
            ],
        ];
        return view('frontend', compact('data', 'categories', 'popular_posts', 'popular_tags', 'featured_posts', 'terbaru', 'cryptoPrices', 'cryptoList'));
    }

    public function isi_post($slug)
    {
        $category_sidebar = Category::all();
        $post = Post::where('slug', $slug)->firstOrFail();

        $data = Post::latest()->paginate(5);

        // Tambahkan views +1
        $post->increment('views');

        // Ambil 3 post dengan views tertinggi
        $popular_posts = Post::orderByDesc('views')->take(3)->get();

        // Ambil tag yang paling sering digunakan
        $popular_tags = Tag::withCount('posts')->orderByDesc('posts_count')->take(10)->get();

        // Popular Post tambahan berdasarkan kategori tertentu
        // $popular_by_category = Post::whereHas('category', function ($query) {
        //     $query->where('name', 'Bitcoin'); // Ganti dengan kategori pilihan
        // })
        // ->orderByDesc('views')
        // ->take(3)
        // ->get();

        return view('blog.isi_post', compact('post', 'category_sidebar', 'popular_posts', 'popular_tags', 'data'));
    }

    public function list_post(Post $posts)
    {
        $category_sidebar = Category::all();
        $data = Post::latest()->paginate(3);

        // Ambil 3 post dengan views tertinggi untuk Popular Post
        $popular_posts = Post::orderByDesc('views')->take(3)->get();

        // Ambil tag yang paling sering digunakan
        $popular_tags = Tag::withCount('posts')->orderByDesc('posts_count')->take(10)->get();

        return view('blog.list', compact('data', 'category_sidebar', 'popular_posts', 'popular_tags'));
    }

    public function list_category(Category $category)
    {
        $category_sidebar = Category::all();
        $data = $category->posts()->paginate(6);

        // Ambil 3 post dengan views tertinggi untuk Popular Post
        $popular_posts = Post::orderByDesc('views')->take(5)->get();

        // Ambil tag yang paling sering digunakan
        $popular_tags = Tag::withCount('posts')->orderByDesc('posts_count')->take(10)->get();
        return view('blog.list', compact('category_sidebar', 'data', 'popular_posts', 'popular_tags'));
    }

    public function list_tag(Tag $tag)
    {
        $category_sidebar = Category::all();
        $data = $tag->posts()->paginate(6);

        // Ambil 3 post dengan views tertinggi untuk Popular Post
        $popular_posts = Post::orderByDesc('views')->take(3)->get();

        // Ambil tag yang paling sering digunakan
        $popular_tags = Tag::withCount('posts')->orderByDesc('posts_count')->take(10)->get();

        return view('blog.list', compact('data', 'category_sidebar', 'popular_posts', 'popular_tags'));
    }

    public function list_artikel(Request $request)
    {
        // List kategori yang ingin ditampilkan
        try {
            $categoryNames = ['Dasar-Dasar Crypto🟢', 'Analisis Pasar📈', 'Berita & Update📰', 'Review & Rekomendasi🟢'];
            $category_data = Category::whereIn('name', $categoryNames)->pluck('id');

            if ($category_data->isEmpty()) {
                Log::error('Kategori tidak ditemukan: ' . implode(', ', $categoryNames));
                return abort(404, 'Kategori tidak ditemukan');
            }

            $data = Post::latest()->paginate(5);

            $category_sidebar = Category::all();
            $data_artikel = Post::with(['users', 'tags'])
                ->whereIn('category_id', $category_data)
                ->latest()
                ->paginate(6);
            // Ambil 3 post dengan views tertinggi untuk Popular Post
            $popular_posts = Post::orderByDesc('views')->take(3)->get();

            // Ambil tag yang paling sering digunakan
            $popular_tags = Tag::withCount('posts')->orderByDesc('posts_count')->take(10)->get();

            return view('blog.artikel', compact('category_sidebar', 'data_artikel', 'categoryNames', 'popular_posts', 'popular_tags', 'data'));
        } catch (\Exception $e) {
            Log::error('Error di list_artikel: ' . $e->getMessage());
            return abort(500, 'Terjadi kesalahan server');
        }
    }
}
