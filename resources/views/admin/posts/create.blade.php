@extends('layouts.app')

@section('content')

    <div class="card mb-4">

        <div class="card-header">
            <h3 class="d-inline">Create new post</h3>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">

                @csrf

                @include('admin.posts._form')

            </form>

        </div>

    </div>

@endsection
