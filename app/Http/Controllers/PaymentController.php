<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
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

        $paymentType = $request->payment_type; // Define paymentType here

        $validTypes = ['news_1bulan', 'news_3bulan', 'news_6bulan', 'membership_3bulan', 'membership_6bulan', 'membership_lifetime'];
        if (!in_array($paymentType, $validTypes)) {
            Alert::error('Jenis pembayaran tidak valid.');
            return redirect('/');
        }

        $product = Product::where('code', $paymentType)->first();
        if (!$product) {
            Alert::error('Produk tidak valid.');
            return redirect('/');
        }
        // Cek pembayaran sebelumnya
        $payment = PaymentConfirmation::where('user_id', $user->id)->where('payment_type', $request->payment_type)->orderBy('created_at', 'desc')->first();

        // Jika pembayaran sebelumnya expired, buat yang baru
        if ($payment && $payment->status === 'expired') {
            $newPayment = PaymentConfirmation::create([
                'user_id' => $user->id,
                'payment_type' => $request->payment_type,
                'amount' => $this->getPrice($request->payment_type),
                'status' => 'pending',
            ]);

            $payment = $newPayment;
        }
        // Jika pembayaran pending tapi sudah expired (lebih dari 5 menit)
        elseif ($payment && $payment->status === 'pending' && $payment->created_at->diffInMinutes(now()) > 5) {
            $payment->update(['status' => 'expired']);

            $newPayment = PaymentConfirmation::create([
                'user_id' => $user->id,
                'payment_type' => $request->payment_type,
                'amount' => $this->getPrice($request->payment_type),
                'status' => 'pending',
            ]);

            $payment = $newPayment;
        }
        // Jika tidak ada pembayaran sama sekali, buat yang baru
        elseif (!$payment) {
            $payment = PaymentConfirmation::create([
                'user_id' => $user->id,
                'payment_type' => $request->payment_type,
                'amount' => $this->getPrice($request->payment_type),
                'status' => 'pending',
            ]);
        }

        // Hitung total dalam IDR
        $basePrice = $product->price; // Harga produk dalam IDR
        $biayaLayanan = $basePrice * 0.1; // Biaya layanan 10%
        $totalBayar = $basePrice + $biayaLayanan;

        // Konversi ke USDT
        $usdRate = $this->getUsdRate();
        $basePriceUsd = $product->price_usd; // Langsung dari produk
        $biayaLayananUsd = $biayaLayanan / $usdRate;
        $totalBayarUsd = $totalBayar / $usdRate;

        return view('payment.confirm', compact('user', 'paymentType', 'product', 'basePrice', 'biayaLayanan', 'totalBayar', 'usdRate', 'basePriceUsd', 'biayaLayananUsd', 'totalBayarUsd'));
        // $amount = $payment- >amount;
        // $biayaLayanan = 4000;
        // $pajak = $amount * 0.1;
        // $totalBayar = $amount;

        // $usdRate = $this->getUsdRate();
        // $biayaLayananUsd = $biayaLayanan / $usdRate;
        // $pajakUsd = $pajak / $usdRate;
        // $totalBayarUsd = $totalBayar / $usdRate;

        // return view('payment.confirm', compact('user', 'paymentType', 'amount', 'biayaLayanan', 'pajak', 'totalBayar', 'usdRate', 'biayaLayananUsd', 'pajakUsd', 'totalBayarUsd', 'product'));
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
            ],
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
        $payments = PaymentConfirmation::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get()->unique('payment_type'); // Hanya ambil yang unik berdasarkan payment_type
        return view('payment.history', compact('payments', 'usdRate'));
    }

    private function getPrice($paymentType)
    {
        $product = Product::where('code', $paymentType)->first();
        if (!$product) {
            throw new \Exception('Product not found');
        }
        return $product->price; // Kembalikan harga dasar saja
    }
}
