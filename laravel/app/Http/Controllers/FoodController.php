<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    public function index(Request $request, $id)
    {
        $ticketsTotal = $request->query('tickets', 0);
        $seats = $request->query('seats', '');

        // 1. Buscamos los productos. El post_type en tu WP es 'food'
        $posts = DB::table('wp_posts')
            ->where('post_type', 'food') 
            ->where('post_status', 'publish')
            ->get();

        $menu = [];

        foreach ($posts as $post) {
            // Sacamos los datos de ACF directamente de la tabla postmeta
            $price = DB::table('wp_postmeta')->where('post_id', $post->ID)->where('meta_key', 'precio')->value('meta_value') ?? 0;
            $category = DB::table('wp_postmeta')->where('post_id', $post->ID)->where('meta_key', 'categoria')->value('meta_value') ?? 'OTROS';
            
            // ACF guarda el ID de la imagen
            $thumbId = DB::table('wp_postmeta')->where('post_id', $post->ID)->where('meta_key', 'imagen')->value('meta_value');
            
            // Buscamos la URL de esa imagen
            $imgUrl = '';
            if ($thumbId) {
                $imgUrl = DB::table('wp_posts')->where('ID', $thumbId)->value('guid');
            }

            // Agrupamos por categoría (esto crea las columnas automáticamente)
            $menu[$category][] = [
                'id' => $post->ID,
                'name' => $post->post_title,
                'price' => (float)$price,
                'image' => $imgUrl
            ];
        }

        return view('food', [
            'id' => $id,
            'menu' => $menu,
            'ticketsTotal' => $ticketsTotal,
            'seats' => $seats
        ]);
    }
}