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

        if (!array_key_exists($id, $bookingMovies)) {
            abort(404, "La película que intentas reservar no existe.");
        }

        // --- 🚀 LÓGICA DE AUTO-SINCRONIZACIÓN ETERNA ---
        // Buscamos si existe alguna sesión que ya haya caducado (fecha anterior a hoy)
        $hasOldSessions = DB::table('showtimes')->where('date', '<', Carbon::today()->toDateString())->exists();

        if ($hasOldSessions) {
            // Buscamos la fecha más antigua que tenemos en la base de datos
            $oldestDateInDb = DB::table('showtimes')->min('date');
            // Calculamos cuántos días han pasado desde esa fecha hasta hoy
            $daysToShift = Carbon::parse($oldestDateInDb)->diffInDays(Carbon::today());

            // Actualizamos TODAS las sesiones de la base de datos sumándoles los días necesarios
            // para que la más vieja empiece hoy. Así el cine siempre está actualizado.
            DB::statement("UPDATE showtimes SET date = DATE_ADD(date, INTERVAL $daysToShift DAY)");
            
            // Opcional: También limpiamos las reservas viejas de la base de datos para que los asientos vuelvan a estar libres
            DB::table('bookings')->truncate(); 
        }
        // --- FIN DE LA SINCRONIZACIÓN ---

        $movie = $bookingMovies[$id];
        
        // 1. Buscamos TODOS los horarios (que ahora estarán garantizados como "Hoy" o futuro)
        $showtimes = DB::table('showtimes')
            ->join('rooms', 'showtimes.room_id', '=', 'rooms.id')
            ->select('showtimes.*', 'rooms.name as room_name')
            ->where('movie_id', $id)
            ->where('date', '>=', Carbon::today()->toDateString())
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        // 2. Averiguamos qué sesión estamos viendo (Por URL o la primera disponible)
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

        // 3. Sacamos los asientos ocupados
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