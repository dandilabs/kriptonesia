<?php

namespace App\Http\Controllers;

use App\Models\CryptoNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;

class MemberController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $expiryData = null;

        $fearGreed = Http::get('https://api.alternative.me/fng/')->json();
        $fearGreedValue = $fearGreed['data'][0]['value'] ?? 'N/A';
        $fearGreedClassification = $fearGreed['data'][0]['value_classification'] ?? 'N/A';

        // Pastikan user memiliki akses
        if ($user->payment_status !== 'paid' || ($user->membership_type !== 'membership_lifetime' && $user->expired_at <= now())) {
            Alert::warning('Akses Dibatasi', 'Membership Anda telah berakhir atau belum aktif.');
            return redirect()->route('member.upgrade');
        }

        $expiryData = [
            'date' => $user->expired_at ? $user->expired_at->format('d M Y') : '-',
            'days_left' => $user->expired_at ? max(0, now()->diffInDays($user->expired_at, false)) : '-',
        ];

        return view('index', compact('expiryData', 'fearGreedValue', 'fearGreedClassification'));
    }

    public function news()
    {
        // Cache data untuk 10 menit
        $trendingData = Cache::remember('trending_crypto_data', 600, function () {
            $response = Http::get('https://api.coingecko.com/api/v3/search/trending');

            if ($response->successful()) {
                return $response->json()['coins'] ?? [];
            }

            return [];
        });

        return view('crypto_news.index', [
            'trendingCoins' => $trendingData,
            'lastUpdated' => now()->format('d M Y H:i:s')
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $news = CryptoNews::when($query, function ($q) use ($query) {
            return $q->where('title', 'like', "%$query%")->orWhere('description', 'like', "%$query%");
        })
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('crypto_news.index', compact('news'));
    }
}
