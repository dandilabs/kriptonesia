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

    public function show($id)
    {
        $signal_trade = TradeSignal::find($id);

        if (!$signal_trade) {
            return redirect()->route('trade.index')->with('error', 'Signal tidak ditemukan');
        }
        return view('membership.signal.show', compact('signal_trade'));
    }
}
