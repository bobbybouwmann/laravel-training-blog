<?php

namespace App\Services;

use App\Post;
use Illuminate\Database\Eloquent\Collection;

class PopularPostsService
{
    public function mostComments($limit = 5): Collection
    {
        $posts = Post::withCount('comments')
            ->published()
            ->orderBy('comments_count', 'desc')
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();

        return $posts;
    }
}
