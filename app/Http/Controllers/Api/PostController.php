<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::all(); // Restituisce tutti i post
        $posts = Post::with('category', 'tags')->paginate(6); // Restituisce i post suddivisi in pagine. Ho definito che ne saranno 6 per pagina.

        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }
}
