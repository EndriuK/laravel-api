<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        $form_data = $request->validated();
        $slug = Post::generateSlug($form_data['title']);
        $form_data['slug'] = $slug;

        // Verifica se request abbia il file cover_image
        if ($request->hasFile('cover_image')) {
            // Effetua l'upload del file e salva il path dell'immagine in una variabile
            $path = $request->file('cover_image')->store('cover_images', 'public');
            // Assegna il valore contenuto nella variabile alla chiave 'cover_image' di 'form_data'
            $form_data['cover_image'] = $path;
        } else {
            // Immagine di placeholder se non è stata caricata un'immagine
            $form_data['cover_image'] = 'https://placehold.co/600x400?text=Immagine+copertina';
        }

        $post = new Post();
        $post->fill($form_data);
        $post->save();

        if ($request->has('tags')) {
            $tags = $request->tags;
            $post->tags()->attach($tags);
        }

        return redirect()->route('admin.posts.index')->with('message', 'Post creato correttamente');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $form_data = $request->validated();

        // Verifica se request abbia il file cover_image
        if ($request->hasFile('cover_image')) {
            // Verifico se il post ha già un'immagine di copertina
            if (Str::startsWith($post->cover_image, 'https') === false) {
                Storage::disk('public')->delete($post->cover_image);
            }

            // Effettua l'upload del file e salva il path dell'immagine in una variabile
            $path = $request->file('cover_image')->store('cover_images', 'public');
            // Assegna il valore contenuto nella variabile alla chiave 'cover_image' di 'form_data'
            $form_data['cover_image'] = $path;
        }

        // Genera lo slug del post
        $form_data['slug'] = Post::generateSlug($form_data['title']);

        $post->update($form_data);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.index')->with('message', 'Post modificato correttamente');
    }

    public function destroy(Post $post)
    {
        if (Str::startsWith($post->cover_image, 'https') === false) {
            Storage::disk('public')->delete($post->cover_image);
        }

        // $post->tags()->sync([]);

        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', 'Post eliminato correttamente');
    }
}
