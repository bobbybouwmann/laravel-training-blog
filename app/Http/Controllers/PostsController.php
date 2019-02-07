<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\View\View;

class PostsController extends Controller
{
    public function index(): View
    {
        $posts = Post::with('user')
            ->withCount('comments')
            ->published()
            ->latest('published_at')
            ->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post): View
    {
        $post->load(['comments.user', 'user']);

        return view('posts.show', compact('post'));
    }
}
