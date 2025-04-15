<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TopHoldingsController extends Controller
{
    public function index($coin_id = 'bitcoin')
    {
        $response = Http::get("https://api.coingecko.com/api/v3/companies/public_treasury/$coin_id");

        if ($response->failed()) {
            abort(404, 'Data tidak ditemukan atau Coin Id salah');
        }

        $holdings = collect($response->json('companies'))->take(15);

        return view('membership.top.index', compact('holdings', 'coin_id'));
    }
}
