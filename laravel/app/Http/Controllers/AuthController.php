<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\SecurityCodeMail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // ==========================================
    // 1. LÓGICA DE LOGIN
    // ==========================================
    public function showLogin() {
        return view('auth.login');
    }

    public function login(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Buscamos al usuario por su email
        $user = \App\Models\User::where('email', $request->email)->first();

        // 1. Verificamos que exista y la contraseña sea correcta
        if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        // 2. --- LÓGICA 2FA REAL ---
        // Generamos un código aleatorio de 6 cifras
        $code = rand(100000, 999999);

        // Se lo guardamos al usuario en la base de datos con caducidad de 10 minutos
        $user->two_factor_code = $code;
        $user->two_factor_expires_at = now()->addMinutes(10);
        $user->save();

        // 3. Enviamos el correo electrónico en tiempo real
        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\SecurityCodeMail($code, $user));

        // 4. Guardamos la ID del usuario temporalmente en la sesión para saber quién intenta entrar
        session(['2fa_user_id' => $user->id]);

        // Redirigimos a la pantalla donde tiene que escribir el código
        return redirect()->route('2fa.form');
    }

    // ==========================================
    // 2. LÓGICA DE REGISTRO
    // ==========================================
    public function showRegister() { 
        return view('auth.register'); 
    }

    public function register(\Illuminate\Http\Request $request)
    {
        // 1. Validar el formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Crear el usuario en la Base de Datos
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'avatar' => $request->avatar ?? 'avatar-default.png',
        ]);

        // 3. Disparar el correo de VERIFICACIÓN (el del botón)
        event(new \Illuminate\Auth\Events\Registered($user));

        // 4. Iniciar sesión automáticamente (Laravel lo necesita para poder verificar)
        \Illuminate\Support\Facades\Auth::login($user);

        // 5. Redirigir a la pantalla de "Aviso: Revisa tu correo"
        return redirect()->route('verification.notice');
    }


    // ==========================================
    // 3. PANTALLA Y COMPROBACIÓN DEL CÓDIGO (2FA)
    // ==========================================
    public function show2faForm() {
        // Si intenta entrar aquí sin haberse logueado o registrado, lo echamos
        if (!session('2fa_user_id')) return redirect('/login');
        
        return view('auth.2fa');
    }

    public function verify2fa(\Illuminate\Http\Request $request)
    {
        // El input de tu formulario HTML debe llamarse name="two_factor_code"
        $request->validate([
            'two_factor_code' => 'required|numeric',
        ]);

        // Recuperamos quién era el que intentaba iniciar sesión
        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['email' => 'Session expired. Please log in again.']);
        }

        $user = \App\Models\User::find($userId);

        // Comprobamos si el código coincide Y si la fecha de caducidad aún no ha pasado
        if ($user->two_factor_code == $request->two_factor_code && $user->two_factor_expires_at > now()) {
            
            // Si el código es correcto limpiamos las columnas de 2FA para que no se puedan reutilizar
            $user->two_factor_code = null;
            $user->two_factor_expires_at = null;
            $user->save();

            // Borramos la variable temporal
            session()->forget('2fa_user_id');

            // ¡Logueamos al usuario de forma oficial en Laravel!
            \Illuminate\Support\Facades\Auth::login($user);

            // Lo mandamos a la portada (o a su perfil)
            return redirect()->route('home');
        }

        return back()->withErrors(['two_factor_code' => 'The security code is invalid or has expired.']);
    }

    // ==========================================
    // 4. CERRAR SESIÓN
    // ==========================================
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}