<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentConfirmation;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentAdminController extends Controller
{
    // Menampilkan daftar pembayaran
    public function index()
    {
        $payments = PaymentConfirmation::with('user')
            ->whereIn('status', ['verifying', 'pending']) // Tampilkan yang perlu diverifikasi
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.payments.index', compact('payments'));
    }

    // Update status pembayaran
    public function updateStatus(Request $request, $id)
    {
        $payment = PaymentConfirmation::findOrFail($id);

        // Validasi bahwa pembayaran memiliki bukti
        if (!$payment->proof) {
            Alert::error('Pembayaran belum memiliki bukti transfer.');
            return redirect()->back();
        }

        // Update status pembayaran
        $payment->update([
            'status' => 'paid',
            'expired_at' => $this->calculateExpiryDate($payment->payment_type)
        ]);

         // Update user
        $payment->user->update([
            'payment_status' => 'paid',
            'membership_type' => $payment->payment_type,
            'expired_at' => $payment->expired_at
        ]);

        Alert::success('Status pembayaran berhasil diperbarui.');
        return redirect()->back();
    }

    private function calculateExpiryDate($paymentType)
    {
        $now = now();

        if ($paymentType == 'news_1hari') {
            return $now->addDay(); // 1 hari
        } elseif ($paymentType == 'news_1bulan') {
            return $now->addMonth(); // 1 bulan
        } elseif ($paymentType == 'news_3bulan') {
            return $now->addMonths(3); // 3 bulan
        } elseif ($paymentType == 'news_6bulan') {
            return $now->addMonths(6); // 6 bulan
        } elseif ($paymentType == 'membership_1bulan') {
            return $now->addMonth(); // 1 bulan
        } elseif ($paymentType == 'membership_3bulan') {
            return $now->addMonths(3); // 3 bulan
        } elseif ($paymentType == 'membership_6bulan') {
            return $now->addMonths(6); // 6 bulan
        }
        // Untuk lifetime
        elseif (str_contains($paymentType, 'lifetime')) {
            return $now->addYears(100); // 100 tahun
        }

        return $now->addDay(); // Default 1 hari
    }
}
