@extends('layouts.app')

@section('content')

    <div class="card mb-4">

        <img src="{{ asset('storage/' . $post->path) }}" class="card-img-top" alt="">

        <div class="card-body">

            <h2 class="card-title">
                {{ $post->title }}
            </h2>

            <h6 class="card-subtitle mb-2 text-muted">
                Published {{ $post->published_at->format('Y-m-d H:i') }}
            </h6>

            <p class="card-text">
                {{ $post->body }}
            </p>

        </div>

    </div>

    @foreach ($post->comments as $comment)

        <div class="card mb-4" id="comment-{{ $comment->id }}">

            <div class="card-header">{{ $comment->user->name }} says:</div>

            <div class="card-body">

                <p class="card-text">{!! nl2br($comment->body) !!}</p>

            </div>

            <div class="card-footer text-muted">{{ $comment->created_at->diffForHumans() }}</div>

        </div>

    @endforeach

    @guest
        <div class="alert alert-secondary mb-4">
            <a href="{{ route('register') }}">Register</a> or <a href="{{ route('login') }}">login</a>
            to leave a comment
        </div>
    @else
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="body">Comment</label>
                        <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"
                                  name="body" id="body" rows="3"
                        >
                            {{ old('body') }}
                        </textarea>
                        @if ($errors->has('body'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    @endguest

@endsection
