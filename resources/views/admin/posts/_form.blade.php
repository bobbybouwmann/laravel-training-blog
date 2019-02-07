<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
           id="title" name="title" value="{{ old('title', $post->title ?? null) }}">
    @if ($errors->has('title'))
        <div class="invalid-feedback">
            {{ $errors->first('title') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" id="body"
              name="body" required>{{ old('body', $post->body ?? null) }}</textarea>
    @if ($errors->has('body'))
        <div class="invalid-feedback">
            {{ $errors->first('body') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="published_at">Publish date</label>
    <input type="datetime-local"
           class="form-control{{ $errors->has('published_at') ? ' is-invalid' : '' }}"
           id="published_at" name="published_at"
           value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : null) }}">
    @if ($errors->has('published_at'))
        <div class="invalid-feedback">
            {{ $errors->first('published_at') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="image">Feature image</label>
    @isset($post)
        @if ($post->path)
            <div>
                <img src="{{ asset('storage/' . $post->path) }}" width="200" class="mb-2">
            </div>
        @endif
    @endisset
    <input type="file"
           class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
           id="image" name="image">
    @if ($errors->has('image'))
        <div class="invalid-feedback">
            {{ $errors->first('image') }}
        </div>
    @endif
</div>

<button type="submit" class="btn btn-primary">Submit</button>
