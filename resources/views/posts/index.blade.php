@extends('layouts.app')

@section('content')

    @foreach ($posts as $post)

        <div class="card mb-4">

            <img src="{{ asset('storage/' . $post->path) }}" class="card-img-top" alt="">

            <div class="card-body">

                <h5 class="card-title">
                    {{ $post->title }}
                </h5>

                <h6 class="card-subtitle mb-2">
                    <span class="badge badge-secondary">
                        {{ $post->comments_count }} {{ $post->comments_count === 1 ? 'comment' : 'comments' }}
                    </span>
                </h6>

                <p class="card-text">{{ $post->summary }}</p>

                <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Continue reading</a>

            </div>

            <div class="card-footer">

                Written by {{ $post->user->name }} - published on {{ $post->published_at->format('Y-m-d') }}

            </div>

        </div>

    @endforeach

    <div class="float-right">
        {{ $posts->links() }}
    </div>

@endsection
