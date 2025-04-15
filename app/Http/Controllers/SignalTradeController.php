<?php

namespace App\Http\Controllers;

use App\Models\TradeSignal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SignalTradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TradeSignal::latest()
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->where('expired_at', '>', now());
            })
            ->get();

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
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'symbol' => 'required|string|max:20',
            'type' => 'required|in:buy,sell,strong_buy,strong_sell',
            'entry_price' => 'required|numeric|min:0',
            'target_price' => 'required|numeric|min:0',
            'stop_loss' => 'required|numeric|min:0',
            'analysis' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'expiry_days' => 'required|integer|min:1|max:30',
            'trade_type' => 'required|in:spot,future',
            'leverage' => 'required_if:trade_type,future|nullable|numeric|min:1|max:100',
        ]);

        try {
            // Handle upload gambar
            $image = $request->file('image');
            $newImageName = time() . '_' . $image->getClientOriginalName();

            // Buat folder jika belum ada
            $uploadPath = public_path('uploads/trade_signals');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Pindahkan file
            $image->move($uploadPath, $newImageName);

            // Simpan path relatif ke database
            $imagePath = 'uploads/trade_signals/' . $newImageName;

            TradeSignal::create([
                'name' => $validated['name'],
                'symbol' => $validated['symbol'],
                'type' => $validated['type'],
                'entry_price' => $validated['entry_price'],
                'target_price' => $validated['target_price'],
                'stop_loss' => $validated['stop_loss'],
                'analysis' => $validated['analysis'],
                'description' => $validated['description'],
                'image' => $imagePath,
                'user_id' => Auth::id(),
                'expired_at' => now()->addDays((int) $validated['expiry_days']),
                'trade_type' => $validated['trade_type'],
                'leverage' => $validated['trade_type'] === 'future' ? $validated['leverage'] : null,
            ]);

            Alert::success('Success', 'Signal berhasil dibuat');
            return redirect()->route('signal-trade.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menyimpan signal: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TradeSignal $signal_trade)
    {
        return view('admin.signal.show', compact('signal_trade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TradeSignal $signal_trade)
    {
        return view('admin.signal.edit', compact('signal_trade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TradeSignal $signal_trade)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'symbol' => 'required|string|max:20',
            'type' => 'required|in:buy,sell,strong_buy,strong_sell',
            'entry_price' => 'required|numeric|min:0',
            'target_price' => 'required|numeric|min:0',
            'stop_loss' => 'required|numeric|min:0',
            'analysis' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'expiry_days' => 'required|integer|min:0|max:30',
            'trade_type' => 'required|in:spot,future',
            'leverage' => 'required_if:trade_type,future|nullable|numeric|min:1|max:100',
        ]);

        // Pastikan nilai integer
        $expiryDays = (int)$validated['expiry_days'];

        try {
            // Handle gambar
            $imagePath = $signal_trade->image;

            // Jika request hapus gambar
            if ($request->has('remove_image') && $request->remove_image) {
                // Hapus file lama
                if ($imagePath && File::exists(public_path($imagePath))) {
                    File::delete(public_path($imagePath));
                }
                $imagePath = null;
            }
            // Jika upload gambar baru
            elseif ($request->hasFile('image')) {
                // Hapus file lama jika ada
                if ($imagePath && File::exists(public_path($imagePath))) {
                    File::delete(public_path($imagePath));
                }

                // Upload file baru
                $image = $request->file('image');
                $newImageName = time() . '_' . $image->getClientOriginalName();
                $uploadPath = public_path('uploads/trade_signals');

                // Buat folder jika belum ada
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true);
                }

                $image->move($uploadPath, $newImageName);
                $imagePath = 'uploads/trade_signals/' . $newImageName;
            }

            // Update masa berlaku jika diperpanjang
            $expiredAt = $signal_trade->expired_at;
            if ($expiryDays > 0) {
                $expiredAt = $expiredAt->copy()->addDays($expiryDays);
            }

            // Update data
            $signal_trade->update([
                'name' => $validated['name'],
                'symbol' => $validated['symbol'],
                'type' => $validated['type'],
                'entry_price' => $validated['entry_price'],
                'target_price' => $validated['target_price'],
                'stop_loss' => $validated['stop_loss'],
                'analysis' => $validated['analysis'],
                'description' => $validated['description'],
                'image' => $imagePath,
                'expired_at' => $expiredAt,
                'trade_type' => $validated['trade_type'],
                'leverage' => $validated['trade_type'] === 'future' ? $validated['leverage'] : null,
            ]);

            Alert::success('Berhasil', 'Signal berhasil diperbarui');
            return redirect()->route('signal-trade.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TradeSignal $signal_trade)
    {
        if ($signal_trade->image) {
            Storage::disk('public')->delete($signal_trade->image);
        }

        $signal_trade->delete();

        Alert::success('Signal deleted successfully');
        return redirect()->route('signal-trade.index');
    }
}
