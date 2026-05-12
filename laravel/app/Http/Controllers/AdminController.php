<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Solo el admin entra aquí
        if (Auth::user()->role !== 'admin') return redirect('/');

        $users = \App\Models\User::all(); 

        // 2. LA SOLUCIÓN: Cambiamos la consulta para que lea de NUESTRA tabla 'reviews'
        $reviews = \Illuminate\Support\Facades\DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            // Le damos alias 'author' y 'content' para que encaje con la vista Blade
            ->select('reviews.*', 'users.name as author', 'reviews.comment as content')
            ->orderBy('reviews.created_at', 'desc')
            ->get();

        return view('admin.index', compact('users', 'reviews'));
    }

    public function updateRole(Request $request, User $user)
    {
        $user->update(['role' => $request->role]);
        return back()->with('status', 'User role updated successfully!');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('status', 'User deleted forever.');
    }

    public function deleteReview($id)
    {
        DB::table('wp_comments')->where('comment_ID', $id)->delete();
        return back()->with('status', 'Review removed.');
    }

    public function updateReviewStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,approved']);
        \Illuminate\Support\Facades\DB::table('reviews')
            ->where('id', $id)
            ->update(['status' => $request->status]);

        return back()->with('status', 'Review status updated successfully!');
    }

    public function sendContact(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'topic' => 'required|string',
            'message' => 'required|string',
        ]);

        try {
            // Usamos Mail::send apuntando a la vista HTML que acabamos de crear ('emails.contact')
            \Illuminate\Support\Facades\Mail::send('emails.contact', ['data' => $data], function ($message) use ($data) {
                $message->to(env('CONTACT_RECEIVER_MAIL', 'kigoiryt@gmail.com'))
                        ->subject('Screenbites Contact: ' . strtoupper($data['topic']));
            });
            
            return back()->with('success', 'Message sent successfully! Our team will contact you soon.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Mail Error: ' . $e->getMessage());
        }
    }
}