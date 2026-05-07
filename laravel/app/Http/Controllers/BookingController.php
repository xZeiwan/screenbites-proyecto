<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function show(Request $request, $id)
    {
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

        // --- LA SOLUCIÓN DE SEGURIDAD ---
        // Comprobamos si el ID existe en el array. Si no existe, lanzamos un error 404 y detenemos la ejecución.
        if (!array_key_exists($id, $bookingMovies)) {
            abort(404, "La película que intentas reservar no existe.");
        }

        $movie = $bookingMovies[$id];
        
        // 1. Buscamos TODOS los horarios futuros para esta película
        $showtimes = DB::table('showtimes')
            ->join('rooms', 'showtimes.room_id', '=', 'rooms.id')
            ->select('showtimes.*', 'rooms.name as room_name')
            ->where('movie_id', $id)
            ->where('date', '>=', Carbon::today()->toDateString())
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        // 2. Averiguamos qué sesión estamos viendo ahora mismo (Por URL o la primera)
        $selectedSessionId = $request->query('session');
        $selectedSession = null;

        if ($showtimes->isNotEmpty()) {
            if ($selectedSessionId) {
                $selectedSession = $showtimes->firstWhere('id', $selectedSessionId);
            }
            if (!$selectedSession) {
                $selectedSession = $showtimes->first(); 
                $selectedSessionId = $selectedSession->id;
            }
        }

        // 3. Sacamos los asientos ocupados SOLO para esta sesión exacta
        $occupiedArray = [];
        if ($selectedSessionId) {
            $occupiedSeatsString = DB::table('bookings')
                ->where('showtime_id', $selectedSessionId) 
                ->pluck('seats')
                ->implode(',');

            $occupiedArray = array_values(array_filter(array_map('trim', explode(',', $occupiedSeatsString))));
        }

        return view('booking', [
            'id' => $id, 
            'movie' => $movie,
            'showtimes' => $showtimes,
            'selectedSession' => $selectedSession,
            'occupiedArray' => $occupiedArray,
        ]);
    }
}