<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function processPayment(Request $request)
    {
        // 1. Recibimos el total que viene del carrito
        $totalGastado = $request->input('total', 0);

        // 2. Lógica de ascenso a VIP
        // Si está logueado, es un usuario normal y ha gastado 40 o más...
        if (Auth::check() && Auth::user()->role === 'user' && $totalGastado >= 40) {
            $user = Auth::user();
            $user->role = 'vip';
            $user->save();
            
            // Mensaje especial de felicitación
            return response()->json([
                'status' => 'success',
                'message' => 'Payment successful! Congratulations, you are now a VIP member!',
                'upgrade' => true
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Payment successful! Thank you for your purchase.',
            'upgrade' => false
        ]);
    }
}
