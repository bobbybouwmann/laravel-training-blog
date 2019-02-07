@extends('layouts.app')

@section('content')

    <div class="card mb-4">

        <div class="card-header">
            <h3 class="d-inline">Posts</h3>

            <div class="float-right d-inline">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary">Create new post</a>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($posts as $post)

                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                {{ $post->title }}<br>
                                <a href="{{ route('posts.show', $post) }}" target="_blank"
                                   class="btn btn-primary btn-sm">View post</a>
                            </td>
                            <td>
                                @if ($post->isPublished())
                                    <span class="badge badge-success">
                                        Published on<br>{{ $post->published_at->format('Y-m-d H:i') }}
                                    </span>
                                @elseif ($post->isScheduledForPublishing())
                                    <span class="badge badge-warning">
                                        Scheduled for<br>{{ $post->published_at->format('Y-m-d H:i') }}
                                    </span>
                                @endif

                            </td>
                            <td>
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary btn-sm mb-1">Edit</a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>

                    @endforeach

                </tbody>


            </table>

        </div>

    </div>

@endsection
