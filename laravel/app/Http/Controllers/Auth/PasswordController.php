<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        // Usamos el "Error Bag" updatePassword que exige Laravel
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)
                ->letters()      // Requiere letras
                ->mixedCase()    // Mayúsculas y minúsculas
                ->numbers()      // Requiere números
                ->symbols()      // Requiere símbolos
            ],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Redirigimos con un mensaje de éxito
        return back()->with('status', 'password-updated');
    }
}