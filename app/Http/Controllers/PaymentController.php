<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaymentConfirmation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Auth\RegisterController;

class PaymentController extends Controller
{
    private function getUsdRate()
    {
        try {
            $apiUrl = 'https://api.coingecko.com/api/v3/simple/price?ids=tether&vs_currencies=idr';
            $response = file_get_contents($apiUrl);
            $data = json_decode($response, true);

            return $data['tether']['idr'] ?? 16500; // Default 16.500 jika API gagal
        } catch (\Exception $e) {
            return 16500; // Default jika terjadi error
        }
    }

    public function showConfirmationForm(Request $request)
    {
        if (!$request->has(['user_id', 'payment_type'])) {
            Alert::warning('Parameter pembayaran tidak lengkap.');
            return redirect('/');
        }

        $user = User::find($request->user_id);

        if (!$user) {
            Alert::error('User tidak ditemukan.');
            return redirect('/');
        }

        // CEK PEMBAYARAN EXPIRED - TAMBAHKAN KODE INI
        $payment = PaymentConfirmation::where('user_id', $user->id)
        ->where('payment_type', $request->payment_type)
        ->where('status', 'pending')
        ->first();

        if ($payment && $payment->created_at->diffInMinutes(now()) > 5) {
            $payment->update(['status' => 'expired']);

            $newPayment = PaymentConfirmation::create([
                'user_id' => $user->id,
                'payment_type' => $request->payment_type,
                'amount' => $this->getPrice($request->payment_type), // Ganti calculateAmount dengan getPrice
                'status' => 'pending',
            ]);

            return redirect()->route('payment.confirm', [
                'user_id' => $user->id,
                'payment_type' => $request->payment_type,
            ]);
        }

        $paymentType = $request->payment_type ?? 'membership'; // **Pastikan variabel ini ada**
        $payment = PaymentConfirmation::where('user_id', $user->id)
            ->where('payment_type', $request->payment_type)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc') // Pastikan ambil yang terbaru
            ->first();

        if (!$payment) {
            Alert::error('Data pembayaran tidak ditemukan.');
            return redirect('/');
        }

        $amount = $payment->amount; // ✅ Ambil dari database

        $biayaLayanan = 4000;
        $pajak = $amount * 0.1;
        $totalBayar = $amount;

        $usdRate = $this->getUsdRate();
        $biayaLayananUsd = $biayaLayanan / $usdRate;
        $pajakUsd = $pajak / $usdRate;
        $totalBayarUsd = $totalBayar / $usdRate;

        return view('payment.confirm', compact('user', 'paymentType', 'amount', 'biayaLayanan', 'pajak', 'totalBayar', 'usdRate', 'biayaLayananUsd', 'pajakUsd', 'totalBayarUsd'));
    }

    // Tampilkan form konfirmasi pembayaran
    // public function showConfirmationForm(Request $request)
    // {
    //     // Cek apakah parameter ada
    //     if (!$request->has(['user_id', 'payment_type', 'amount'])) {
    //         return redirect('/')->with('error', 'Parameter pembayaran tidak lengkap.');
    //     }

    //     $user = User::find($request->user_id);

    //     // Pastikan user valid
    //     if (!$user) {
    //         return redirect('/')->with('error', 'User tidak ditemukan.');
    //     }

    //     $paymentType = $request->payment_type; // 'membership' atau 'news'
    //     $amount = $request->amount; // Jumlah yang harus dibayar

    //     // **Hitung Total Bayar (Biaya + Pajak + Layanan)**
    //     $biayaLayanan = 4000;
    //     $pajak = $amount * 0.1;
    //     $totalBayar = $amount + $biayaLayanan + $pajak;

    //     // **Ambil kurs USD real-time**
    //     $usdRate = $this->getUsdRate();
    //     $biayaLayananUsd = $biayaLayanan / $usdRate;
    //     $pajakUsd = $pajak / $usdRate;
    //     $totalBayarUsd = $totalBayar / $usdRate;

    //     return view('payment.confirm', compact('user', 'paymentType', 'amount', 'biayaLayanan', 'pajak', 'totalBayar', 'usdRate', 'biayaLayananUsd', 'pajakUsd', 'totalBayarUsd'));
    // }

    // Proses unggah bukti pembayaran
    public function processConfirmation(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'payment_type' => 'required|string',
            'amount' => 'required|numeric',
            'proof' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = User::findOrFail($request->user_id);

        $payment = PaymentConfirmation::updateOrCreate(
            [
                'user_id' => $user->id,
                'payment_type' => $request->payment_type,
                'status' => 'pending',
            ],
            [
                'amount' => $request->amount,
                'proof' => $this->storeProof($request->file('proof')),
                'status' => 'verifying', // Ubah status menjadi verifying
            ]
        );

        // Update user status
        $user->payment_status = 'verifying'; // Tambahkan ini
        $user->save();

        // Logout user
        // if ($payment->status == 'paid') {
        //     Auth::logout();
        // }

        Alert::success('Pembayaran Berhasil', 'Bukti pembayaran telah dikirim dan sedang diproses.');
        return redirect('/');
    }

    private function storeProof($file)
    {
        $proofName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti'), $proofName);
        return 'uploads/bukti/' . $proofName;
    }

    public function showHistory()
    {
        $usdRate = $this->getUsdRate(); // Ambil kurs USDT terbaru
        // Hanya tampilkan pembayaran terakhir per jenis pembayaran
        $payments = PaymentConfirmation::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get()
        ->unique('payment_type'); // Hanya ambil yang unik berdasarkan payment_type
        return view('payment.history', compact('payments','usdRate'));
    }
}
