<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaymentConfirmation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
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
            return redirect('/')->with('error', 'Parameter pembayaran tidak lengkap.');
        }

        $user = User::find($request->user_id);

        if (!$user) {
            return redirect('/')->with('error', 'User tidak ditemukan.');
        }

        $paymentType = $request->payment_type ?? 'membership'; // **Pastikan variabel ini ada**
        $payment = PaymentConfirmation::where('user_id', $user->id)
            ->where('payment_type', $request->payment_type)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc') // Pastikan ambil yang terbaru
            ->first();

        if (!$payment) {
            return redirect('/')->with('error', 'Data pembayaran tidak ditemukan.');
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
            ],
        );

        // Update user status
        $user->payment_status = 'pending';
        $user->save();

        // Logout user
        Auth::logout();

        return redirect('/')->with('success', 'Bukti pembayaran berhasil diupload. Silakan tunggu verifikasi admin.');
    }

    private function storeProof($file)
    {
        $proofName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti'), $proofName);
        return 'uploads/bukti/' . $proofName;
    }

    public function showHistory()
    {
        $payments = PaymentConfirmation::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('payment.history', compact('payments'));
    }
}
