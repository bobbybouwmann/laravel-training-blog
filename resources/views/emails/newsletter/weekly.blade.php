@component('mail::message')
# Weekly Blog Update

There has been a full month of awesome new blog posts! Here is a summary of all published blog posts from last week!

@foreach ($posts as $post)

@component('mail::button', ['url' => route('posts.show', $post)])
    Read {{ $post->title }}
@endcomponent

@endforeach

Next week we're back with more!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
