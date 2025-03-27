<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaymentConfirmation;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Hitung statistik dasar
        return view('home', [
            'totalUsers' => User::count(),
            'totalPosts' => Post::count(),
            'newUsers' => User::where('created_at', '>=', now()->subDays(30))->count(),
            'totalRevenue' => PaymentConfirmation::where('status', 'paid')->sum('amount')
        ]);
        }

    private function getRegistrationStats()
    {
        $stats = [
            'labels' => [],
            'data' => []
        ];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $stats['labels'][] = $date->format('d M');
            $stats['data'][] = User::whereDate('created_at', $date)->count();
        }

        return $stats;
    }
}
