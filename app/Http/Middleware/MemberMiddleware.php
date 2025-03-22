<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek status pembayaran di tabel payment_confirmations
        $payment = DB::table('payment_confirmations')
            ->where('user_id', Auth::user()->id)
            ->where('status', 'paid')
            ->first();

        // Jika pembayaran sudah berhasil, izinkan akses
        if ($payment) {
            return $next($request);
        }

        // Jika tidak memenuhi syarat, redirect ke home dengan pesan error
        return redirect('/')->with('error', 'Akses dashboard hanya untuk member berbayar yang sudah melakukan pembayaran.');
        //  // Jika user sudah login dan memiliki role = 0 (member)
        // if (Auth::check() && Auth::user()->role == 0) {
        //     return $next($request); // Izinkan akses
        // }

        // // Redirect ke home jika bukan member
        // return redirect('/')->with('error', 'Akses ditolak! Anda bukan member.');
    }
}
