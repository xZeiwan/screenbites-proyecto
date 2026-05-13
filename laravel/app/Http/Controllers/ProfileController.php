<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        // 1. Traemos las reservas
        $bookings = DB::table('bookings')
            ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->join('rooms', 'showtimes.room_id', '=', 'rooms.id')
            ->where('bookings.user_id', Auth::id())
            ->select(
                'bookings.*', 
                'showtimes.movie_id', 
                'showtimes.date as movie_date', 
                'showtimes.time as movie_time',
                'rooms.name as room_name'
            )
            ->orderBy('bookings.created_at', 'desc')
            ->get();

        // 2. Traemos TODAS las pelis de WP para tener los nombres y posters
        $wordpressUrl = "http://127.0.0.1/screenbites-proyecto/wp/wp-json/wp/v2/pelicula?acf_format=standard&per_page=100";
        
        try {
            $response = \Illuminate\Support\Facades\Http::withoutVerifying()->get($wordpressUrl);
            $wpMovies = $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            $wpMovies = [];
        }

        // 3. Mapeamos los nombres para que la vista los encuentre fácil
        $movieData = [];
        foreach ($wpMovies as $post) {
            $idLaravel = $post['acf']['id_laravel'] ?? null;
            if ($idLaravel) {
                $movieData[$idLaravel] = [
                    'title' => $post['title']['rendered'],
                    'poster' => $post['acf']['poster'] ?? ''
                ];
            }
        }

        return view('profile', [
            'user' => $request->user(),
            'bookings' => $bookings,
            'movieData' => $movieData 
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // 1. Validamos manualmente para incluir el avatar
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'avatar' => 'nullable|string',
        ]);

        $user = $request->user();

        // 2. Asignamos los valores
        $user->name = $request->name;
        $user->email = $request->email;

        // 3. LA CLAVE: Guardamos el avatar que viene del input hidden
        if ($request->has('avatar')) {
            $user->avatar = $request->avatar;
        }

        // Si el email cambió, invalidamos la fecha de verificación
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}