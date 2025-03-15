<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
         // Jika user sudah login dan memiliki role = 0 (member)
        if (Auth::check() && Auth::user()->role == 0) {
            return $next($request); // Izinkan akses
        }

        // Redirect ke home jika bukan member
        return redirect('/')->with('error', 'Akses ditolak! Anda bukan member.');
    }
}
