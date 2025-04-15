<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CryptoCalendarController extends Controller
{

    public function index()
    {
        $apiKey = '484588d9496f4b7:jg5ls9ribd94utu'; // ganti dengan apikey dari https://tradingeconomics.com/api/
        $response = Http::get("https://api.tradingeconomics.com/calendar?c=$apiKey");

        $data = $response->json();

        return view('membership.calender.index', compact('data'));
    }
}
