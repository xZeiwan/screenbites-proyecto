<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function processPayment(Request $request)
    {
        // 1. VALIDACIÓN EN EL SERVIDOR 
        $request->validate([
            'cart' => 'required|array',
            'method' => 'required|string|in:card,paypal,bizum',
            
            // Usamos un array en lugar de texto para que el pipe "|" del regex no rompa Laravel
            'payment_data.cardNumber' => ['required_if:method,card', 'string', 'size:16'],
            'payment_data.cardExpiry' => [
                'required_if:method,card', 
                'string', 
                'size:5', 
                'regex:/^(0[1-9]|1[0-2])\/[0-9]{2}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('/', $value);
                    if (count($parts) === 2) {
                        $month = (int)$parts[0];
                        $year = (int)$parts[1] + 2000;
                        
                        $currentYear = (int)now()->format('Y');
                        $currentMonth = (int)now()->format('m');

                        // 1. Comprobar que no sea del pasado (Caducada)
                        if ($year < $currentYear || ($year === $currentYear && $month < $currentMonth)) {
                            $fail('This card has expired.');
                        }
                        
                        // 2. Comprobar que no sea un futuro absurdo (ej: año 2099)
                        // Las tarjetas bancarias suelen tener un máximo de 5 a 8 años de validez
                        if ($year > $currentYear + 10) {
                            $fail('The expiration year is invalid.');
                        }
                    }
                }
            ],
            'payment_data.cardCVC' => ['required_if:method,card', 'string', 'size:3'],
            
            'payment_data.phone' => ['required_if:method,bizum', 'string', 'size:9'],
            'payment_data.email' => ['required_if:method,paypal', 'email'],
        ]);

        $cart = $request->input('cart');

        if (empty($cart)) {
            return response()->json(['status' => 'error', 'message' => 'Empty cart'], 400);
        }

        // 2. PROCESAMIENTO
        foreach ($cart as $order) {
            if (isset($order['tickets']) && $order['tickets']['seats'] !== 'None') {
                DB::table('bookings')->insert([
                    'user_id' => \Illuminate\Support\Facades\Auth::id(),
                    'showtime_id' => $order['sessionId'], 
                    'seats' => $order['tickets']['seats'],          
                    'food' => isset($order['food']) ? json_encode($order['food']) : null,                    
                    'total_price' => $order['orderTotal'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return response()->json(['status' => 'success']);
    }
}