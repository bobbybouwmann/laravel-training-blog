@extends('layouts.app')

@section('content')

    <div class="card mb-4">

        <div class="card-header">
            <h3 class="d-inline">Comments</h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Post</th>
                        <th>User</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($comments as $comment)

                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->body }}</td>
                            <td>
                                {{ $comment->user->name }}<br>
                                <a href="{{ route('posts.show', $comment->post) }}#comment-{{ $comment->id }}"
                                   target="_blank" class="btn btn-primary btn-sm">View post</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST">
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
