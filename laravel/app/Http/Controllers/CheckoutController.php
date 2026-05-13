<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session as StripeSession;

class CheckoutController extends Controller
{
    public function processPayment(Request $request)
    {
        $request->validate([
            'cart' => 'required|array',
            'method' => 'required|string|in:card,paypal,bizum,demo',
        ]);

        $cart = $request->input('cart');
        if (empty($cart)) {
            return response()->json(['status' => 'error', 'message' => 'Empty cart'], 400);
        }

        $user = \Illuminate\Support\Facades\Auth::user();
        $isVip = $user && $user->role === 'vip';
        
        // Calcular total
        $totalAmount = 0;
        foreach ($cart as $order) {
            if (isset($order['tickets']) && $order['tickets']['seats'] !== 'None') {
                $itemPrice = $order['orderTotal'];
                if ($isVip) $itemPrice = $itemPrice - ($itemPrice * 0.10);
                $totalAmount += $itemPrice;
            }
        }

        Stripe::setApiKey(config('services.stripe.secret'));
        $amountInCents = (int) round($totalAmount * 100);

        // --- CASO DEMO ---
        if ($request->input('method') === 'demo' && $totalAmount > 0) {
            try {
                // 1. Guarda el ticket en tu base de datos para que salga en el Profile
                $revealedMovieId = $this->saveToDatabase($cart, $user, $isVip);
                
                // 2. Comprobamos si hay un evento misterioso en el carrito
                $hasBlindTicket = false;
                foreach ($cart as $order) {
                    if ($order['movieId'] === 'blind-01') {
                        $hasBlindTicket = true;
                        break;
                    }
                }
                
                // 3. Devolvemos éxito al navegador para que proceda
                return response()->json([
                    'status' => 'success',
                    'revealed_movie_id' => $revealedMovieId,
                    'has_blind' => $hasBlindTicket
                ]);

            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
            }
        }

        // --- CASO 1: PAGO CON TARJETA (Directo y sin salir de la página) ---
        if ($request->input('method') === 'card' && $totalAmount > 0) {
            try {
                $paymentIntent = PaymentIntent::create([
                    'amount' => $amountInCents,
                    'currency' => 'eur', // Bizum exige Euros, unificamos todo a EUR
                    'payment_method' => $request->input('payment_data.paymentMethodId'),
                    'confirm' => true,
                    'automatic_payment_methods' => ['enabled' => true, 'allow_redirects' => 'never']
                ]);

                if ($paymentIntent->status !== 'succeeded') {
                    return response()->json(['status' => 'error', 'message' => 'Payment failed.'], 400);
                }

                // Guardar en Base de Datos
                $revealedMovieId = $this->saveToDatabase($cart, $user, $isVip);
                
                return response()->json([
                    'status' => 'success',
                    'revealed_movie_id' => $revealedMovieId 
                ]);

            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
            }
        }

        // --- CASO 2: PAYPAL O BIZUM (Requieren redirección) ---
        if (in_array($request->input('method'), ['paypal', 'bizum']) && $totalAmount > 0) {
            try {
                // Guardamos el carrito en la memoria del servidor (Session) para cuando vuelva
                session(['pending_checkout_cart' => $cart]);

                $method = $request->input('method') === 'bizum' ? ['bizum'] : ['paypal'];

                $session = StripeSession::create([
                    'payment_method_types' => $method,
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => ['name' => 'Screenbites Cinema Order'],
                            'unit_amount' => $amountInCents,
                        ],
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'success_url' => route('checkout.success'),
                    'cancel_url' => route('checkout.cancel'),
                ]);

                // Le devolvemos la URL de Stripe al Frontend
                return response()->json([
                    'status' => 'redirect',
                    'url' => $session->url
                ]);

            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
            }
        }
    }

    // --- FUNCIÓN QUE RECIBE AL USUARIO CUANDO VUELVE DE PAGAR CON ÉXITO ---
    public function success()
    {
        $cart = session('pending_checkout_cart');
        
        if (!$cart) {
            return redirect('/profile')->with('status', 'Payment successful!');
        }

        $user = \Illuminate\Support\Facades\Auth::user();
        $isVip = $user && $user->role === 'vip';

        // 1. Guardamos en Base de datos y obtenemos la peli revelada
        $revealedMovieId = $this->saveToDatabase($cart, $user, $isVip);

        $hasBlindTicket = false;
        foreach ($cart as $order) {
            if ($order['movieId'] === 'blind-01') {
                $hasBlindTicket = true;
                break;
            }
        }

        // 3. Limpiamos la memoria
        session()->forget('pending_checkout_cart');

        // 4. CARGAMOS LA PANTALLA ANIMADA DE ÉXITO EN LUGAR DEL PERFIL
        return view('checkout-success', [
            'hasBlindTicket' => $hasBlindTicket,
            'revealedMovieId' => $revealedMovieId
        ]);
    }

    // --- FUNCIÓN QUE RECIBE AL USUARIO SI CANCELA EL PAGO ---
    public function cancel()
    {
        return redirect('/cart')->with('status', 'Payment cancelled.');
    }

    // --- LÓGICA DE BASE DE DATOS ---
    private function saveToDatabase(array $cart, \App\Models\User $user, bool $isVip)
    {
        $revealedMovieId = null;
        $specialEvents = ['blind-01', 'horror-01', 'tarantino-01', '35mm-01'];

        foreach ($cart as $order) {
            if (isset($order['tickets']) && $order['tickets']['seats'] !== 'None') {
                
                $showtimeId = $order['sessionId'] ?? null;
                $seats = $order['tickets']['seats'];
                $finalPrice = $order['orderTotal'];
                if ($isVip) $finalPrice = $finalPrice - ($finalPrice * 0.10);

                $eventIdForDatabase = null;

                if (in_array($order['movieId'], $specialEvents)) {
                    $eventIdForDatabase = $order['movieId']; 
                    $futureShowtimes = DB::table('showtimes')->where('date', '>=', Carbon::today()->toDateString())->get();
                    
                    if ($futureShowtimes->isNotEmpty()) {
                        $randomShowtime = $futureShowtimes->random();
                        $showtimeId = $randomShowtime->id;
                        $revealedMovieId = $randomShowtime->movie_id; 
                        
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
        return $revealedMovieId;
    }
}