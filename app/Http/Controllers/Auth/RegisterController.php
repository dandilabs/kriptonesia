<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaymentConfirmation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'membership_type' => ['nullable', 'string'], // 🔹 Bisa kosong (nullable)
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $membershipType = $data['membership_type'] ?? null;
        return DB::transaction(function () use ($data, $membershipType) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'membership_type' => $membershipType,
                'payment_status' => $membershipType ? 'pending' : 'free',
            ]);

            if (!empty($membershipType)) {
                $paymentType = str_contains($membershipType, 'news') ? 'news' : 'membership';

                // **Cek apakah sudah ada pembayaran pending**
                $existingPayment = PaymentConfirmation::lockForUpdate()->where('user_id', $user->id)->where('payment_type', $paymentType)->where('status', 'pending')->first();

                if (!$existingPayment) {
                    PaymentConfirmation::create([
                        'user_id' => $user->id,
                        'payment_type' => $paymentType,
                        'amount' => $this->getPrice($membershipType),
                        'status' => 'pending',
                    ]);
                }
            }

            return $user;
        });
    }

    // 🔹 Fungsi mendapatkan harga berdasarkan paket yang dipilih
    public function getPrice($membership_type)
    {
        $prices = [
            'news_1hari' => 5000,
            'news_1bulan' => 50000,
            'news_3bulan' => 120000,
            'news_6bulan' => 200000,
            'news_lifetime' => 500000,
            'membership_1bulan' => 250000,
            'membership_3bulan' => 500000,
            'membership_6bulan' => 1500000,
            'membership_lifetime' => 3000000,
        ];

        $basePrice = $prices[$membership_type] ?? 0;
        $biayaLayanan = 4000; // Bisa diganti sesuai kebutuhan
        $pajak = $basePrice * 0.1; // Misalnya pajak 10%

        return $basePrice + $biayaLayanan + $pajak;
    }

    // 🔹 Override redirect setelah registrasi
    protected function registered(Request $request, $user)
    {
        // Jika user memilih membership, arahkan ke halaman konfirmasi pembayaran
        if ($user->membership_type && $user->membership_type !== 'free') {
            return redirect()
                ->route('payment.confirm', [
                    'user_id' => $user->id,
                    'payment_type' => str_contains($user->membership_type, 'news') ? 'news' : 'membership',
                    'amount' => $this->getPrice($user->membership_type),
                ])
                ->with('message', 'Silakan konfirmasi pembayaran.');
        }

        // Jika user memilih free, arahkan ke home
        return redirect('/')->with('message', 'Pendaftaran berhasil. Silakan login.');
    }
}
