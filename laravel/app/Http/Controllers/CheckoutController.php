<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Necesitamos Carbon para las fechas

class CheckoutController extends Controller
{
    public function processPayment(Request $request)
{
    // 1. VALIDACIÓN
    $request->validate([
        'cart' => 'required|array',
        'method' => 'required|string|in:card,paypal,bizum',
        // ... (tus validaciones de tarjeta/bizum/paypal que ya tienes)
    ]);

    $cart = $request->input('cart');
    if (empty($cart)) {
        return response()->json(['status' => 'error', 'message' => 'Empty cart'], 400);
    }

    $revealedMovieId = null;
    $user = \Illuminate\Support\Facades\Auth::user();
    $isVip = $user && $user->role === 'vip';

    // Lista de IDs que activan la ruleta de película aleatoria
    $specialEvents = ['blind-01', 'horror-01', 'tarantino-01', '35mm-01'];

    foreach ($cart as $order) {
        if (isset($order['tickets']) && $order['tickets']['seats'] !== 'None') {
            
            $showtimeId = $order['sessionId'] ?? null;
            $seats = $order['tickets']['seats'];
            $finalPrice = $order['orderTotal'];

            // Aplicar descuento VIP si procede
            if ($isVip) {
                $finalPrice = $finalPrice - ($finalPrice * 0.10);
            }

            $eventIdForDatabase = null;

            // --- LÓGICA DE EVENTOS ESPECIALES ---
            if (in_array($order['movieId'], $specialEvents)) {
                $eventIdForDatabase = $order['movieId']; 

                // Buscamos una sesión real al azar para que el ticket sea válido
                $futureShowtimes = DB::table('showtimes')
                                     ->where('date', '>=', \Carbon\Carbon::today()->toDateString())
                                     ->get();
                
                if ($futureShowtimes->isNotEmpty()) {
                    $randomShowtime = $futureShowtimes->random();
                    $showtimeId = $randomShowtime->id;
                    $revealedMovieId = $randomShowtime->movie_id; 
                    
                    // Si el asiento es "Mystery Seat", le asignamos uno real
                    if($seats === 'Mystery Seat' || $seats === 'Survival Seat') {
                        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
                        $seats = $rows[array_rand($rows)] . rand(1, 10);
                    }
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

    return response()->json([
        'status' => 'success',
        'revealed_movie_id' => $revealedMovieId 
    ]);
}
}