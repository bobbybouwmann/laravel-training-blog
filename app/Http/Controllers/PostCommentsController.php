<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Post;
use Illuminate\Http\RedirectResponse;

class PostCommentsController extends Controller
{
    public function store(CommentRequest $request, Post $post): RedirectResponse
    {
        $comment = new Comment($request->only('body'));
        $comment->user()->associate($request->user());

        $post->comments()->save($comment);

        session()->flash('message', 'Comment successfully created');

        return redirect()->route('posts.show', $post);
    }
}
