@inject('popularPosts', 'App\Services\PopularPostsService')

<div class="card">

    <div class="card-header">
        Posts with the most comments
    </div>

    <ul class="list-group list-group-flush">

        @foreach ($popularPosts->mostComments() as $post)

            <li class="list-group-item">
                <h5><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h5>
                {{ $post->comments_count }} {{ $post->comments_count === 0 ? 'comment' : 'comments' }}
            </li>

        @endforeach

    </ul>

</div>
