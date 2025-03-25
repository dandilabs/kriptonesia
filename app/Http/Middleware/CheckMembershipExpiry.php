<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMembershipExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->membership_expired_at && now() > Auth::user()->membership_expired_at) {
            $user = Auth::user();
            $user->update([
                'membership_type' => 'free',
                'payment_status' => 'free',
                'expired_at' => null
            ]);
        }

        return $next($request);
    }
}
