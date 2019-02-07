<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentsController extends Controller
{
    public function index(): View
    {
        $comments = Comment::with(['post', 'user'])->get();

        return view('admin.comments.index', compact('comments'));
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        session()->flash(
            'message',
            'Comment has been deleted'
        );

        return redirect()->route('admin.comments.index');
    }
}
