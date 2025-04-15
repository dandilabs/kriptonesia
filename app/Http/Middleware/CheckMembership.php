<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMembership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Admin bisa lewat
            if ($user->role == 1) {
                return $next($request);
            }

            // Cek jika membership expired
            if ($user->payment_status === 'paid' && $user->expired_at && $user->expired_at->lt(now())) {
                $user->update([
                    'payment_status' => 'expired',
                    'membership_type' => 'free',
                ]);

                return redirect()->route('member.upgrade')->with('error', 'Membership Anda sudah expired. Silakan perpanjang untuk melanjutkan.');
            }

            // Jika bukan member aktif
            if ($user->payment_status !== 'paid' || !$user->expired_at || $user->expired_at->lt(now())) {
                return redirect()->route('member.upgrade')->with('error', 'Anda perlu membership aktif untuk mengakses halaman ini.');
            }
        }

        return $next($request);
    }
}
