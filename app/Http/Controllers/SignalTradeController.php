<?php

namespace App\Http\Controllers;

use App\Models\TradeSignal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignalTradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TradeSignal::latest()->get();
        return view('admin.signal.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.signal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name'          => 'required|min:3',
            'content'       => 'required',
            'image'         => 'required'
        ]);

        $image_data = $request->image;
        $new_image = time().$image_data->getClientOriginalName();

        $trade = TradeSignal::create([
            'name'          => $request->name,
            'content'       => $request->content,
            'image'         => 'public/uploads/trade/'. $new_image,
            'users_id'      => Auth::id()
        ]);

        $image_data->move('public/uploads/trade/', $new_image);

        return redirect()->route('signal-trade.index')->with('success', 'Signal create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
