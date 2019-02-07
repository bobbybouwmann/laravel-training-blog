@extends('layouts.app')

@section('content')

    <div class="card mb-4">

        <div class="card-header">
            <h3 class="d-inline">Edit post</h3>

            <div class="float-right d-inline">
                <a href="{{ route('posts.show', $post) }}" target="_blank" class="btn btn-sm btn-primary">View post</a>
            </div>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                @include('admin.posts._form')

            </form>

        </div>

    </div>

@endsection
