<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaymentConfirmation;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentAdminController extends Controller
{
    // Menampilkan daftar pembayaran
    public function index()
    {
        // $payments = PaymentConfirmation::with('user')
        //     ->whereIn('status', ['verifying', 'pending']) // Tampilkan yang perlu diverifikasi
        //     ->orderBy('created_at', 'desc')
        //     ->get();
        // Update otomatis semua yang sudah expired
        PaymentConfirmation::where('status', 'paid')
            ->where('expired_at', '<', now())
            ->each(function ($payment) {
                $payment->update(['status' => 'expired']);
                $payment->user->update(['payment_status' => 'expired']);
            });

        $payments = PaymentConfirmation::with('user')
            ->whereIn('status', ['verifying', 'pending', 'expired'])
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

        $expiredAt = $this->calculateExpiryDate($payment->payment_type);
        // Update status pembayaran
        $payment->update([
            'status' => 'paid',
            'expired_at' => $expiredAt,
        ]);

        // Update user
        $payment->user->update([
            'payment_status'   => 'paid',
            'membership_type'  => $payment->payment_type,
            'expired_at'       => $expiredAt ? $expiredAt->toDateTimeString() : null,
        ]);

        Alert::success('Status pembayaran berhasil diperbarui.');
        return redirect()->back();
    }

    private function calculateExpiryDate($paymentType)
    {
        $now = now();

        if ($paymentType == 'news_1hari') {
            return $now->addDay();
        } elseif ($paymentType == 'news_1bulan') {
            return $now->addMonth();
        } elseif ($paymentType == 'news_3bulan') {
            return $now->addMonths(3);
        } elseif ($paymentType == 'news_6bulan') {
            return $now->addMonths(6);
        } elseif ($paymentType == 'membership_1bulan') {
            return $now->addMonth();
        } elseif ($paymentType == 'membership_3bulan') {
            return $now->addMonths(3);
        } elseif ($paymentType == 'membership_6bulan') {
            return $now->addMonths(6);
        } elseif (str_contains($paymentType, 'lifetime')) {
            return null; // biar expired_at nya kosong (lifetime)
        }

        return $now->addDay(); // default fallback
    }

    public function setExpired($id)
    {
        // $payment = PaymentConfirmation::findOrFail($id);
        // $user = User::findOrFail($payment->user_id);

        // $payment->update(['status' => 'expired']);
        // $user->update(['payment_status' => 'expired']);
        $payment = PaymentConfirmation::findOrFail($id);

        $payment->update(['status' => 'expired']);
        $payment->user->update(['payment_status' => 'expired']);
        Alert::success('Status berhasil diubah ke expired');
        return redirect()->back();
    }
}
