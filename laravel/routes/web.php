<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;

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
        "02" => ["title" => "Five Nights at Freddy's", "bgImg" => "img/2-Five-Nights/Portada.png", "bg" => "#1a0429", "textColor" => "white"],
        "03" => ["title" => "Godzilla", "bgImg" => "img/3-Godzilla/Portada.png", "bg" => "#0a2233", "textColor" => "white"],
        "04" => ["title" => "Oppenheimer", "bgImg" => "img/4-Oppenheimer/Portada.png", "bg" => "#2e1409", "textColor" => "white"],
        "05" => ["title" => "Up", "bgImg" => "img/5-Up/Portada.png", "bg" => "#a1cce0", "textColor" => "black"],
        "06" => ["title" => "The Joker", "bgImg" => "img/6-The-Joker/Portada.png", "bg" => "#120908", "textColor" => "white"],
        "07" => ["title" => "Alien", "bgImg" => "img/7-Alien/Portada.png", "bg" => "#051417", "textColor" => "white"],
        "08" => ["title" => "Interstellar", "bgImg" => "img/8-Interstellar/Portada.png", "bg" => "#090a0a", "textColor" => "white"],
        "09" => ["title" => "Barbie", "bgImg" => "img/9-Barbie/Portada.png", "bg" => "#51caf5", "textColor" => "white"],
        "10" => ["title" => "Mamma Mia", "bgImg" => "img/10-MammaMia/Portada.jpg", "bg" => "#b3d0e2", "textColor" => "black"],
        "11" => ["title" => "Deadpool & Wolverine", "bgImg" => "img/11-Deadpool/Portada.png", "bg" => "#aa0000", "textColor" => "white"],
        "12" => ["title" => "Gladiator II", "bgImg" => "img/12-Gladiator/Portada.png", "bg" => "#d4af37", "textColor" => "black"],
        "13" => ["title" => "Venom 3", "bgImg" => "img/13-Venom/Portada.png", "bg" => "#630000", "textColor" => "black"],
        "14" => ["title" => "Mufasa", "bgImg" => "img/14-Mufasa/Portada.png", "bg" => "#ffa500", "textColor" => "black"],
        "15" => ["title" => "Kraven", "bgImg" => "img/15-Kraven/Portada.png", "bg" => "#8b4513", "textColor" => "white"]
    ];

    $movie = $bookingMovies[$id] ?? ["title" => "Película Desconocida", "bgImg" => "", "bg" => "#ffd000", "textColor" => "black"];
    return view('booking', ['id' => $id, 'movie' => $movie]);
})->name('booking.show');


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
});