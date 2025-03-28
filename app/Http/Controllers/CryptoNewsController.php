<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class CryptoNewsController extends Controller
{
    public function getCryptoNews(Request $request)
    {
        $category_sidebar = Category::all();
        $popular_posts = Post::orderByDesc('views')->take(3)->get();
        $popular_tags = Tag::withCount('posts')->orderByDesc('posts_count')->take(10)->get();

        $apiKey = config('services.newsdata.api_key');
        $page = $request->query('page', 1); // Ambil halaman dari query string
        $perPage = 10; // Jumlah berita per halaman

        $url = "https://newsdata.io/api/1/news?apikey={$apiKey}&q=crypto&language=id,en&page={$page}";

        $response = Http::get($url);

        if ($response->failed()) {
            return abort(500, 'Gagal mengambil berita dari NewsData.io');
        }

        $data = $response->json();

        // Pastikan API mengembalikan data dengan benar
        if (!isset($data['results']) || empty($data['results'])) {
            return abort(500, 'Data tidak tersedia dari API NewsData.io');
        }

        // Ubah array ke Collection
        $news = collect($data['results']);

        // Total results kadang tidak ada di response API
        $totalResults = $data['totalResults'] ?? $page * $perPage + count($news);

        // Buat pagination manual
        $pagination = new LengthAwarePaginator($news, $totalResults, $perPage, $page, ['path' => url()->current()]);

        return view('crypto_news.index', compact('pagination', 'category_sidebar', 'popular_posts', 'popular_tags'));
    }
}
