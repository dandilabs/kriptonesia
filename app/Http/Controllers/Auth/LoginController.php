<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Tambahkan flash message ketika login gagal
    protected function sendFailedLoginResponse(Request $request)
    {
        Alert::error('Email atau password salah. Silakan coba lagi.');
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'));
    }

    // Tambahkan flash message ketika login berhasil
    protected function authenticated(Request $request, $user)
    {
        Alert::success('Login berhasil! Selamat datang kembali.');
        return redirect($this->redirectTo);
    }
}
