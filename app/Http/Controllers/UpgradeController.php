<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentConfirmation;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UpgradeController extends Controller
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
    public function showForm()
    {
        $usdRate = $this->getUsdRate();
        // Ambil hanya produk aktif, dan kelompokkan berdasarkan tipe
        $products = Product::where('is_active', true)->orderBy('type')->orderBy('price_usd')->get()->groupBy('type');
        return view('member.upgrade', compact('usdRate', 'products'));
    }

    public function processUpgrade(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);

        // Hapus pembayaran pending sebelumnya
        PaymentConfirmation::where('user_id', $user->id)->where('status', 'pending')->delete();

        // Simpan harga produk asli TANPA biaya tambahan
        $payment = PaymentConfirmation::create([
            'user_id' => $user->id,
            'payment_type' => $product->code,
            'amount' => $product->price, // Hanya harga produk
            'status' => 'pending',
        ]);
        // $payment = PaymentConfirmation::create([
        //     'user_id' => $user->id,
        //     'payment_type' => $request->membership_type,
        //     'amount' => $totalAmount,
        //     'status' => 'pending',
        // ]);

        // Update user status
        $user->payment_status = 'pending';
        $user->save();

        // Logout user
        // Auth::logout();

        Alert::success('Silakan lakukan pembayaran.');

        return redirect()->route('payment.confirm', [
            'user_id' => $user->id,
            'payment_type' => $product->code,
        ]);
    }

    // public function getPrice($membershipType)
    // {
    //     $prices = [
    //         'news_1hari' => 5000,
    //         'news_1bulan' => 50000,
    //         'news_3bulan' => 120000,
    //         'news_6bulan' => 200000,
    //         'news_lifetime' => 500000,
    //         'membership_1bulan' => 250000,
    //         'membership_3bulan' => 500000,
    //         'membership_6bulan' => 1500000,
    //         'membership_lifetime' => 3000000,
    //     ];

    //     $basePrice = $prices[$membershipType] ?? 0;
    //     $biayaLayanan = 4000; // Biaya tambahan layanan
    //     $pajak = $basePrice * 0.1; // Pajak 10%

    //     return $basePrice + $biayaLayanan + $pajak;
    // }
}
