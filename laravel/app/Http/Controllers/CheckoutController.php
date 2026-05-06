<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function processPayment(Request $request)
    {
        $cart = $request->input('cart');

        if (!$cart || empty($cart)) {
            return response()->json(['status' => 'error', 'message' => 'Empty cart'], 400);
        }

        foreach ($cart as $order) {
            // Solo insertamos si hay asientos (por si en el futuro vendes solo comida)
            if (isset($order['tickets']) && $order['tickets']['seats'] !== 'None') {
                DB::table('bookings')->insert([
                    'user_id' => Auth::id(),
                    'movie_id' => $order['movieId'],
                    'seats' => $order['tickets']['seats'],
                    'total_price' => $order['orderTotal'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return response()->json(['status' => 'success']);
    }
}