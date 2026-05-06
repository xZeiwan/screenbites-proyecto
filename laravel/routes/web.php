<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;

// --- 1. PORTADA ---
Route::get('/', function () {
    return view('index'); 
})->name('home');


// --- 2. PELÍCULAS (PÚBLICO) ---
// Esta ruta es la que carga los datos desde WordPress a través del MovieController
Route::get('/pelicula/{id}', [MovieController::class, 'show'])->name('pelicula.show');


// --- 3. RESERVA DE ENTRADAS (BOOKING) ---
// Mantenemos el array estático aquí para que funcione rápido sin depender de la API de WP para el diseño
Route::get('/booking/{id}', function ($id) {
    $bookingMovies = [
        "01" => ["title" => "Kill Bill", "bgImg" => "img/1-Kill-Bill/Portada.png", "bg" => "#ffd000", "textColor" => "black"],
        "02" => ["title" => "Five Nights at Freddy's", "bgImg" => "img/2-Five-Nights/Portada.png", "bg" => "#8c44f7", "textColor" => "white"],
        "03" => ["title" => "Godzilla", "bgImg" => "img/3-Godzilla/Portada.png", "bg" => "#00a2ff", "textColor" => "white"],
        "04" => ["title" => "Oppenheimer", "bgImg" => "img/4-Oppenheimer/Portada.png", "bg" => "#e85d04", "textColor" => "white"], 
        "05" => ["title" => "Up", "bgImg" => "img/5-Up/Portada.png", "bg" => "#a1cce0", "textColor" => "black"],
        "06" => ["title" => "The Joker", "bgImg" => "img/6-The-Joker/Portada.png", "bg" => "#4ade80", "textColor" => "black"],
        "07" => ["title" => "Alien", "bgImg" => "img/7-Alien/Portada.png", "bg" => "#22c55e", "textColor" => "black"], 
        "08" => ["title" => "Interstellar", "bgImg" => "img/8-Interstellar/Portada.png", "bg" => "#94a3b8", "textColor" => "black"], 
        "09" => ["title" => "Barbie", "bgImg" => "img/9-Barbie/Portada.png", "bg" => "#ff69b4", "textColor" => "white"], 
        "10" => ["title" => "Mamma Mia", "bgImg" => "img/10-MammaMia/Portada.jpg", "bg" => "#b3d0e2", "textColor" => "black"],
        "11" => ["title" => "Deadpool & Wolverine", "bgImg" => "img/11-Deadpool/Portada.png", "bg" => "#ef4444", "textColor" => "white"],
        "12" => ["title" => "Gladiator II", "bgImg" => "img/12-Gladiator/Portada.png", "bg" => "#d4af37", "textColor" => "black"],
        "13" => ["title" => "Venom 3", "bgImg" => "img/13-Venom/Portada.png", "bg" => "#991b1b", "textColor" => "white"], 
        "14" => ["title" => "Mufasa", "bgImg" => "img/14-Mufasa/Portada.png", "bg" => "#ffa500", "textColor" => "black"],
        "15" => ["title" => "Kraven", "bgImg" => "img/15-Kraven/Portada.png", "bg" => "#d97706", "textColor" => "white"] 
    ];

    $movie = $bookingMovies[$id] ?? ["title" => "Película Desconocida", "bgImg" => "", "bg" => "#ffd000", "textColor" => "black"];
    
    // --- LÓGICA DE BACKEND PARA SACAR ASIENTOS OCUPADOS ---
    $occupiedSeatsString = \Illuminate\Support\Facades\DB::table('bookings')
        ->where('movie_id', $id)
        ->pluck('seats')
        ->implode(',');

    // AÑADIMOS array_values() PARA QUE JAVASCRIPT LO ENTIENDA PERFECTAMENTE
    $occupiedArray = array_values(array_filter(array_map('trim', explode(',', $occupiedSeatsString))));

    return view('booking', [
        'id' => $id, 
        'movie' => $movie,
        'occupiedArray' => $occupiedArray,
    ]);
})->name('booking.show');

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
    Route::patch('/admin/user/{user}/role', [AdminController::class, 'updateRole'])->name('admin.updateRole');
    Route::delete('/admin/user/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::delete('/admin/review/{id}', [AdminController::class, 'deleteReview'])->name('admin.deleteReview');
});