<?php

namespace App\Http\Controllers;

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
        return view('member.upgrade', compact('usdRate'));
    }

    public function processUpgrade(Request $request)
    {
        $request->validate([
            'membership_type' => 'required|string|in:news_1hari,news_1bulan,news_3bulan,news_6bulan,news_lifetime,membership_1bulan,membership_3bulan,membership_6bulan,membership_lifetime',
        ]);

        $user = Auth::user();

        // Hapus pembayaran pending sebelumnya
        PaymentConfirmation::where('user_id', $user->id)->where('status', 'pending')->delete();

        // Hitung total harga termasuk pajak dan biaya layanan
        $totalAmount = $this->getPrice($request->membership_type);

        // Buat payment baru
        $payment = PaymentConfirmation::create([
            'user_id' => $user->id,
            'payment_type' => $request->membership_type,
            'amount' => $totalAmount,
            'status' => 'pending',
        ]);

        // Update user status
        $user->payment_status = 'pending';
        $user->save();

        // Logout user
        // Auth::logout();

        Alert::success('Silakan lakukan pembayaran.');
        return redirect()
            ->route('payment.confirm', [
                'user_id' => $user->id,
                'payment_type' => $request->membership_type,
            ]);
    }

    public function getPrice($membershipType)
    {
        $prices = [
            'news_1hari' => 5000,
            'news_1bulan' => 50000,
            'news_3bulan' => 120000,
            'news_6bulan' => 200000,
            'news_lifetime' => 500000,
            'membership_1bulan' => 250000,
            'membership_3bulan' => 500000,
            'membership_6bulan' => 1500000,
            'membership_lifetime' => 3000000,
        ];

        $basePrice = $prices[$membershipType] ?? 0;
        $biayaLayanan = 4000; // Biaya tambahan layanan
        $pajak = $basePrice * 0.1; // Pajak 10%

        return $basePrice + $biayaLayanan + $pajak;
    }
}
