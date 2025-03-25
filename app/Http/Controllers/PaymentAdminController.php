<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentConfirmation;

class PaymentAdminController extends Controller
{
    // Menampilkan daftar pembayaran
    public function index()
    {
        $payments = PaymentConfirmation::whereNotNull('proof') // Hanya yang punya bukti
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.payments.index', compact('payments'));
    }

    // Update status pembayaran
    public function updateStatus(Request $request, $id)
    {
        $payment = PaymentConfirmation::findOrFail($id);
        $payment->status = 'paid';
        $expiredAt = $this->calculateExpiryDate($payment->payment_type);
        $payment->expired_at = $expiredAt;
        $payment->save();

        $user = $payment->user;
        $user->update([
            'payment_status' => 'paid',
            'membership_type' => $payment->payment_type,
            'expired_at' => $expiredAt, // Pastikan nama kolomnya benar
        ]);

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
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
