<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// --- 1. PORTADA ---
Route::get('/', function () {
    return view('index'); 
})->name('home');


// --- 2. PELÍCULAS (PÚBLICO) ---
// Esta ruta es la que carga los datos desde WordPress a través del MovieController
Route::get('/pelicula/{id}', [MovieController::class, 'show'])->name('pelicula.show');

// --- 3. RESERVA DE ENTRADAS (BOOKING) ---
Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
Route::get('/booking/{id}/food', [FoodController::class, 'index'])->name('booking.food');

// Ruta Comida
Route::get('/booking/{id}/food', [FoodController::class, 'index'])->name('booking.food');

// --- EL CARRITO ---
Route::get('/cart', function () {
    return view('cart');
})->name('cart.index');

// --- RUTA PARA LA PÁGINA DE PAGO ---
Route::get('/checkout', function () {
    return view('checkout', [
        'id' => 'global', // Le pasamos un ID genérico para que no falle el HTML
        'movie' => [
            'title' => 'Complete your order',
            'bgImg' => ''
        ]
    ]);
})->middleware('auth')->name('checkout.index');


// --- 4. AUTENTICACIÓN (GUEST) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registro', [AuthController::class, 'register']);
    Route::get('/2fa', [AuthController::class, 'show2faForm'])->name('2fa.form');
    Route::post('/2fa', [AuthController::class, 'verify2fa'])->name('2fa.verify');
});

// Rutas de verificación de email
Route::middleware('auth')->group(function () {
    // 1. La pantalla que le dice al usuario "Oye, ve a mirar tu correo"
    Route::get('/email/verify', function () {
        return view('auth.verify'); // Tendremos que crear esta pequeña vista HTML
    })->name('verification.notice');

    // 2. La ruta que se ejecuta cuando el usuario hace clic en el enlace del correo
    Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill(); // Marca el correo como verificado en la Base de Datos
        return redirect('/')->with('status', 'Email successfully verified!'); // <-- AQUÍ CAMBIAMOS A '/'
    })->middleware(['signed'])->name('verification.verify');

    // 3. El botón para reenviar el correo si se ha perdido
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent again!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});


// --- 5. RUTAS PROTEGIDAS (AUTH) ---
Route::middleware('auth')->group(function () {
    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cambiar la contraseña
    Route::put('/password', [\App\Http\Controllers\Auth\PasswordController::class, 'update'])->name('password.update');

    // Guardar reseñas (enviamos al controlador para procesar con WordPress)
    Route::post('/pelicula/{id}/review', [MovieController::class, 'storeReview'])->name('pelicula.review');

    Route::post('/process-payment', [CheckoutController::class, 'processPayment'])->name('checkout.pay');

    Route::get('/admin-panel', [AdminController::class, 'index'])->name('admin.index');
    Route::patch('/admin-panel/review/{id}/status', [\App\Http\Controllers\AdminController::class, 'updateReviewStatus'])->name('admin.updateReviewStatus');
    Route::delete('/admin-panel/review/{id}', [\App\Http\Controllers\AdminController::class, 'deleteReview'])->name('admin.deleteReview');
    Route::patch('/admin/user/{user}/role', [AdminController::class, 'updateRole'])->name('admin.updateRole');
    Route::delete('/admin/user/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::delete('/admin/review/{id}', [AdminController::class, 'deleteReview'])->name('admin.deleteReview');
});

Route::get('/event/blind-ticket', function () {
    return view('special-events.blind-ticket');
})->name('events.blind');

Route::get('/event/horror-marathon', function () { 
    return view('special-events.horror-marathon'); 
})->name('events.horror');

Route::get('/event/director-tarantino', function () { 
    return view('special-events.director-tarantino'); 
})->name('events.tarantino');

Route::get('/event/classic-projection', function () { 
    return view('special-events.classic-projection'); 
})->name('events.35mm');

Route::get('/locations', function () { 
    return view('locations'); 
})->name('locations');

Route::get('/contact', function () { 
    return view('contact'); 
})->name('contact');

Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

// --- POLÍTICA DE PRIVACIDAD  ---
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.policy');

Route::post('/contact/send', [\App\Http\Controllers\AdminController::class, 'sendContact'])->name('contact.send');

Route::get('/verify-email-demo', [AuthController::class, 'verifyEmailDemo'])->name('verification.verify.demo')->middleware('auth');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::post('/update-cookie-consent', [App\Http\Controllers\AdminController::class, 'updateCookieConsent'])->name('cookie.update');