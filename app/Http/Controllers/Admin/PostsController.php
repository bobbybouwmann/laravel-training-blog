<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostsController extends Controller
{
    public function index(): View
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.posts.create');
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $user = $request->user();
        $post = $user->posts()->create($request->all());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts');

            $post->update([
                'path' => $path,
            ]);
        }

        session()->flash(
            'message',
            $this->getFlashMessageForCreating($post)
        );

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $wasPublished = $post->isPublished();
        $wasScheduledForPublishing = $post->isScheduledForPublishing();

        $post->update($request->all());

        if ($request->hasFile('image')) {
            if ($post->path !== null) {
                Storage::delete($post->path);
            }

            $path = $request->file('image')->store('posts');

            $post->update([
                'path' => $path,
            ]);
        }

        session()->flash(
            'message',
            $this->getFlashMessageForUpdating($post, $wasPublished, $wasScheduledForPublishing)
        );

        return redirect()->route('admin.posts.edit', $post);
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        session()->flash(
            'message',
            'Post with title "' . $post->title . '" has been removed and is now unpublished'
        );

        return redirect()->route('admin.posts.index');
    }

    private function getFlashMessageForCreating(Post $post): string
    {
        if ($post->isScheduledForPublishing()) {
            return 'Post has been created and scheduled for publishing';
        }

        if ($post->isPublished()) {
            return 'Post has been created and published';
        }

        return 'Post has been created and is not scheduled for publishing';
    }

    private function getFlashMessageForUpdating(
        Post $post,
        bool $wasPublished = false,
        bool $wasScheduledForPublishing = false
    ): string {
        if ($wasPublished && !$post->isPublished()) {
            return 'Post has been updated and unpublished';
        }

        if ($wasScheduledForPublishing && !$post->isScheduledForPublishing()) {
            return 'Post has been updated and removed from published schedule';
        }

        if ($post->isScheduledForPublishing()) {
            return 'Post has been updated and scheduled for publishing on '
                . $post->published_at->format('D j F Y \a\t H:i');
        }

        if ($post->isPublished()) {
            return 'Post has been updated and published';
        }

        return 'Post has been updated and is not scheduled for publishing';
    }
}
