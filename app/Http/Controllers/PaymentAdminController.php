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
        $payment->status = 'paid'; // Ubah status pembayaran menjadi 'paid'
        $payment->save();

        // **Cari user berdasarkan user_id dari pembayaran ini**
        $user = $payment->user;

        // **Update membership_type berdasarkan jenis pembayaran**
        if ($payment->payment_type == 'membership') {
            $user->membership_type = 'membership_6bulan'; // Bisa diubah sesuai dengan sistem paketnya
        } elseif ($payment->payment_type == 'news') {
            $user->membership_type = 'news_lifetime'; // Bisa diubah sesuai sistem paketnya
        }

        $user->save(); // Simpan perubahan di tabel users

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui dan membership user diperbarui.');
    }
}
