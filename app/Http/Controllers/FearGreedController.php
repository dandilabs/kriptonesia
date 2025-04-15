<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\FearGreedIndex;
use Illuminate\Support\Facades\Http;

class FearGreedController extends Controller
{
    public function index()
    {
        // Ambil data terbaru dari API (contoh)
        $response = Http::get('https://api.alternative.me/fng/');
        $data = $response->json();

        // Simpan ke database
        FearGreedIndex::create([
            'value' => $data['data'][0]['value'],
            'label' => $data['data'][0]['value_classification'],
            'timestamp' => now()
        ]);

        // Ambil data untuk ditampilkan
        $indices = FearGreedIndex::orderBy('timestamp', 'desc')->take(30)->get();

        return view('membership.fear_greed.index', compact('indices'));
    }

    public function getData()
    {
        $data = Http::get('https://api.alternative.me/fng/')->json();

        return response()->json([
            'value' => (int) $data['data'][0]['value'],
        ]);
    }
}
