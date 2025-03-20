<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class PaymentController extends Controller
{
    public function create(Request $request)
{
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = false;
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $service_fee = 5000; // Biaya layanan
    $total_price = $request->price + $service_fee;

    $order_id = uniqid();

    $params = [
        'transaction_details' => [
            'order_id' => $order_id,
            'gross_amount' => $total_price, // Total harga sudah termasuk biaya layanan
        ],
        'customer_details' => [
            'first_name' => $request->name,
            'email' => $request->email,
        ],
    ];

    $snapToken = Snap::getSnapToken($params);

    return response()->json(['snap_token' => $snapToken]);
}
}
