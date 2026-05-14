<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class AdminPostPreviewController extends Controller
{
    public function show(Post $post): View
    {
        return view('admin-preview.posts.show', [
            'post' => $post->load(['author', 'reviewer']),
        ]);
    }
}
