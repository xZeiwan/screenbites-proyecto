<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Necesitamos Carbon para las fechas

class CheckoutController extends Controller
{
    public function processPayment(Request $request)
    {
        // 1. VALIDACIÓN EN EL SERVIDOR 
        $request->validate([
            'cart' => 'required|array',
            'method' => 'required|string|in:card,paypal,bizum',
            
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

                        if ($year < $currentYear || ($year === $currentYear && $month < $currentMonth)) {
                            $fail('This card has expired.');
                        }
                        
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

        $revealedMovieId = null;

        // --- SACAMOS AL USUARIO Y COMPROBAMOS SI ES VIP ---
        $user = \Illuminate\Support\Facades\Auth::user();
        $isVip = $user && $user->role === 'vip';

        // 2. PROCESAMIENTO
        foreach ($cart as $order) {
            if (isset($order['tickets']) && $order['tickets']['seats'] !== 'None') {
                
                $showtimeId = $order['sessionId'] ?? null;
                $seats = $order['tickets']['seats'];
                $finalPrice = $order['orderTotal']; // Precio base que viene del carrito

                // --- APLICAR DESCUENTO VIP 10% EN EL SERVIDOR ---
                if ($isVip) {
                    $finalPrice = $finalPrice - ($finalPrice * 0.10);
                }

                $eventIdForDatabase = null; // Por defecto es null

                if ($order['movieId'] === 'blind-01') {
                    // Guardamos de qué evento viene para bloquearlo en el futuro
                    $eventIdForDatabase = 'blind-01'; 

                    $futureShowtimes = DB::table('showtimes')
                                         ->where('date', '>=', \Carbon\Carbon::today()->toDateString())
                                         ->get();
                    
                    if ($futureShowtimes->isNotEmpty()) {
                        $randomShowtime = $futureShowtimes->random();
                        $showtimeId = $randomShowtime->id;
                        $revealedMovieId = $randomShowtime->movie_id; 
                        
                        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
                        $seats = $rows[array_rand($rows)] . rand(1, 10);
                    }
                }

                if ($showtimeId) {
                    DB::table('bookings')->insert([
                        'user_id' => $user->id,
                        'showtime_id' => $showtimeId, 
                        'event_id' => $eventIdForDatabase,
                        'seats' => $seats,          
                        'food' => isset($order['food']) ? json_encode($order['food']) : null,                    
                        'total_price' => $finalPrice, 
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // 3. DEVOLVEMOS EL ID A LA WEB
        return response()->json([
            'status' => 'success',
            'revealed_movie_id' => $revealedMovieId 
        ]);
    }
}