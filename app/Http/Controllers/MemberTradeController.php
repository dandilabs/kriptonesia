<?php

namespace App\Http\Controllers;

use App\Models\TradeSignal;
use Illuminate\Http\Request;

class MemberTradeController extends Controller
{
    public function index()
    {
        $data = TradeSignal::latest()->get();
        return view('membership.signal.index', compact('data'));
    }
}
