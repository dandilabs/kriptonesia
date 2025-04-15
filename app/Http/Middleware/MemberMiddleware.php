<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentConfirmation;
use Symfony\Component\HttpFoundation\Response;

class MemberMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        $isLifetime = $user->membership_type === 'membership_lifetime';

        // Auto update expired khusus non-lifetime
        if ($user->payment_status === 'paid' && !$isLifetime && $user->expired_at < now()) {
            $user->update(['payment_status' => 'expired']);

            PaymentConfirmation::where('user_id', $user->id)
                ->where('status', 'paid')
                ->where('expired_at', '<', now())
                ->update(['status' => 'expired']);
        }

        // Kalau user lifetime atau masih aktif, lanjut
        if ($user->payment_status === 'paid' || $isLifetime) {
            return $next($request);
        }

        // Kalau user free member, boleh akses halaman upgrade
        if ($request->routeIs('member.upgrade*')) {
            return $next($request);
        }

        // Kalau ada payment yang sudah paid tapi belum expired
        $payment = DB::table('payment_confirmations')->where('user_id', $user->id)->where('status', 'paid')->first();

        if ($payment) {
            return $next($request);
        }

        // Kalau semua gagal → tendang ke home
        return redirect('/')->with('error', 'Akses dashboard hanya untuk member berbayar yang sudah melakukan pembayaran.');
    }
}
