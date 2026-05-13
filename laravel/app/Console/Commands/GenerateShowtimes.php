<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenerateShowtimes extends Command
{
    // El nombre que usarás en la terminal
    protected $signature = 'cinema:generate-showtimes';
    protected $description = 'Genera la cartelera para los próximos 7 días automáticamente';

    public function handle()
    {
        $this->info('Arrancando el motor del cine...');

        // 1. Obtener las IDs de las salas (Si no hay, paramos)
        $rooms = DB::table('rooms')->pluck('id')->toArray();
        
        if (empty($rooms)) {
            $this->error('¡No tienes salas creadas! Ve a tu Base de Datos y crea la Sala 1, Sala VIP, etc.');
            return;
        }

        // 2. Las IDs de tus 15 películas
        $movieIds = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15'];
        
        // 3. Los horarios estándar de tu cine
        $showtimesList = ['16:00:00', '18:30:00', '21:00:00', '23:30:00'];

        $showsCreated = 0;

        // 4. Bucle para asegurar que siempre haya 7 días de cartelera
        for ($i = 0; $i < 7; $i++) {
            $targetDate = Carbon::today()->addDays($i)->toDateString();

            foreach ($rooms as $roomId) {
                foreach ($showtimesList as $time) {
                    
                    // ¿Ya hay algo programado en esta sala a esta hora?
                    $exists = DB::table('showtimes')
                        ->where('room_id', $roomId)
                        ->where('date', $targetDate)
                        ->where('time', $time)
                        ->exists();

                    // Si la sala está libre, ponemos una película al azar
                    if (!$exists) {
                        $randomMovie = $movieIds[array_rand($movieIds)];

                        DB::table('showtimes')->insert([
                            'movie_id' => $randomMovie,
                            'room_id' => $roomId,
                            'date' => $targetDate,
                            'time' => $time,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $showsCreated++;
                    }
                }
            }
        }

        if ($showsCreated > 0) {
            $this->info("¡Cartelera actualizada! Se han creado $showsCreated funciones nuevas.");
        } else {
            $this->line("La cartelera ya estaba completa. No se han creado funciones nuevas.");
        }
    }
}