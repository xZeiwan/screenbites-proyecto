<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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
    // app/Http/Controllers/ProfileController.php

    public function edit(Request $request)
    {
        // 1. Traemos las reservas
        $bookings = DB::table('bookings')
            ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->join('rooms', 'showtimes.room_id', '=', 'rooms.id')
            ->where('bookings.user_id', auth()->id())
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
        // Usamos la misma lógica que ya tienes en MovieController
        $wordpressUrl = "http://127.0.0.1/screenbites-proyecto/wp/wp-json/wp/v2/pelicula?acf_format=standard&per_page=100";
        $response = \Illuminate\Support\Facades\Http::withoutVerifying()->get($wordpressUrl);
        $wpMovies = $response->successful() ? $response->json() : [];

        // 3. Mapeamos los nombres para que la vista los encuentre fácil
        // Creamos un diccionario: ['01' => 'Kill Bill', '02' => 'FNAF'...]
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
            'movieData' => $movieData // Pasamos este "diccionario" a la vista
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Guardamos el avatar si viene en la petición
        if ($request->has('avatar')) {
            $request->user()->avatar = $request->avatar;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'Profile updated');
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