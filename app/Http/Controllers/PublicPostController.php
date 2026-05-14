<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PublicPostController extends Controller
{
    public function index(): View
    {
        return view('posts.index', [
            'posts' => Post::query()
                ->whereNotNull('published_at')
                ->with('author')
                ->latest('published_at')
                ->get(),
        ]);
    }

    public function show(Post $post): View
    {
        abort_if($post->published_at === null, 404);

        return view('posts.show', [
            'post' => $post->load('author'),
            'relatedPosts' => Post::query()
                ->whereNotNull('published_at')
                ->whereKeyNot($post->id)
                ->latest('published_at')
                ->limit(3)
                ->get(),
        ]);
    }
}
