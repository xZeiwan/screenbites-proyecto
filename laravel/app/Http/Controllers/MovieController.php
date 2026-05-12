<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MovieController extends Controller
{
    public function show(string $id)
    {
        $wordpressUrl = "http://127.0.0.1/screenbites-proyecto/wp"; 

        try {
            $response = Http::withoutVerifying()->timeout(15)->get("{$wordpressUrl}/wp-json/wp/v2/pelicula", [
                'acf_format' => 'standard',
                'per_page' => 100
            ]);

            if ($response->failed()) {
                // Si la API falla, mostramos el 404 en lugar de texto plano
                return response()->view('errors.404', [], 404);
            }

            $allMovies = $response->json();

            // 1. Buscar por id_laravel
            $wpMovie = collect($allMovies)->first(function($m) use ($id) {
                return isset($m['acf']['id_laravel']) && (int)$m['acf']['id_laravel'] === (int)$id;
            });

            if (!$wpMovie) {
                // SOLUCIÓN: Devolvemos tu nueva vista 404 directamente
                return response()->view('errors.404', [], 404);
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
            return response()->view('errors.404', [], 404);
        }
    }

    public function storeReview(\Illuminate\Http\Request $request, string $id)
    {
        // 1. Validamos los datos y ponemos el mensaje en INGLÉS
        $request->validate([
            'score' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1000',
            'privacy_policy' => 'accepted', 
        ], [
            'privacy_policy.accepted' => 'You must read and accept the Privacy Policy to submit a review.'
        ]);

        // 2. Guardamos SOLO los datos que le importan a la base de datos (ignorando el privacy_policy)
        DB::table('reviews')->insert([
            'user_id' => Auth::id(),
            'movie_id' => $id,
            'rating' => $request->score,     
            'comment' => $request->content,
            'status' => 'pending',            
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('status', 'Review submitted successfully! Waiting for approval.');
    }
}