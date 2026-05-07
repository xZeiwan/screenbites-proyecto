<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MovieController extends Controller
{
    public function show($id)
    {
        $wordpressUrl = "http://127.0.0.1/screenbites-proyecto/wp"; 

        try {
            $response = Http::withoutVerifying()->timeout(15)->get("{$wordpressUrl}/wp-json/wp/v2/pelicula", [
                'acf_format' => 'standard',
                'per_page' => 100
            ]);

            if ($response->failed()) {
                return "Error de API: La URL " . $wordpressUrl . "/wp-json/wp/v2/pelicula no es válida o WP está caído.";
            }

            $allMovies = $response->json();

            // 1. Buscar por id_laravel
            $wpMovie = collect($allMovies)->first(function($m) use ($id) {
                return isset($m['acf']['id_laravel']) && (int)$m['acf']['id_laravel'] === (int)$id;
            });

            if (!$wpMovie) {
                return abort(404, "No existe película en WP con id_laravel: " . $id);
            }

            $acf = $wpMovie['acf'];

            // 2. Procesar Trailers y Galería
            $trailerRaw = $acf['trailer_url'] ?? '';
            $trailerEmbed = str_replace(['watch?v=', 'youtu.be/'], ['embed/', 'youtube.com/embed/'], $trailerRaw);

            $gallery = [];
            for ($i = 1; $i <= 4; $i++) {
                if (!empty($acf["imagen_$i"])) $gallery[] = $acf["imagen_$i"];
            }

            // 3. Mapear datos para el Blade 
            $movie = [
                "title"   => $wpMovie['title']['rendered'],
                "desc"    => strip_tags($wpMovie['content']['rendered']),
                "age"     => $acf['edad'] ?? "?",
                "genre"   => $acf['genero'] ?? "Acción",
                "bgImg"   => $acf['bgimg'] ?? $acf['portada'] ?? "", 
                "poster"  => $acf['poster'] ?? "",
                "bg"      => $acf['bg'] ?? $acf['color_de_fondo'] ?? "#000000",
                "textColor" => $acf['textcolor'] ?? "white",
                "trailer" => $trailerEmbed,
                "gallery" => $gallery,
                "isComingSoon" => filter_var($acf['iscomingsoon'] ?? false, FILTER_VALIDATE_BOOLEAN),
                "releaseDate"  => $acf['releasedate'] ?? "",
                "menuSpecial"  => [
                    "enabled" => filter_var($acf['menu_special_enable'] ?? false, FILTER_VALIDATE_BOOLEAN),
                    "title"   => $acf['menu_special_title'] ?? "",
                    "text"    => $acf['menu_special_text'] ?? "",
                    "image"   => $acf['menu_special_img'] ?? ""    
                ]
            ];

            // 4. Buscamos las sesiones de ESTA película a partir de hoy
            $showtimes = DB::table('showtimes')
                ->join('rooms', 'showtimes.room_id', '=', 'rooms.id')
                ->select('showtimes.*', 'rooms.name as room_name')
                ->where('movie_id', $id)
                ->where('date', '>=', Carbon::today()->toDateString())
                ->orderBy('date')
                ->orderBy('time')
                ->get()
                ->groupBy('date');

            // 5. Obtener Reseñas
            $reviews = [];
            $resReviews = Http::withoutVerifying()->get("{$wordpressUrl}/wp-json/wp/v2/reviews?per_page=100");
            if ($resReviews->successful()) {
                foreach ($resReviews->json() as $review) {
                    $wp_id = $review['acf']['id_pelicula_laravel'] ?? null;
                    if ($wp_id !== null && (int)$wp_id === (int)$id) {
                        $reviews[] = [
                            'title' => $review['title']['rendered'],
                            'content' => strip_tags($review['content']['rendered']),
                            'score' => intval($review['acf']['puntuacion'] ?? 0),
                        ];
                    }
                }
            }

            // 6. RETORNAMOS TODO DE GOLPE
            return view('pelicula', compact('id', 'movie', 'showtimes', 'reviews'));

        } catch (\Exception $e) {
            return "ERROR CRÍTICO: " . $e->getMessage();
        }
    }
}