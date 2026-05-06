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

        $users = User::where('id', '!=', Auth::id())->get();
        
        // Obtenemos las reseñas (asumiendo la estructura de Alex con WordPress)
        $reviews = DB::table('wp_comments')
            ->select('comment_ID as id', 'comment_author as author', 'comment_content as content', 'comment_post_ID as movie_id')
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
}