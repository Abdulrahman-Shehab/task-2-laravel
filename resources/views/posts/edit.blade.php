@extends('layouts.app')

@section('title', 'Add Post')

@section('content')
    <div class="container">
        <h1 class="title">Update Post Number {{ $post->id }}</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="postTitle">Post Title : </label>
                <input class="form-control" type="text" name="title" id="postTitle" value="{{ $post->title }}">
            </div>
            <div class="mb-3">
                <label for="postDes" class="form-label">Post Description</label>
                <textarea class="form-control" id="postDes" name="description" rows="3">{{ $post->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="postImg" class="form-label">Click To Change</label>
                <input class="form-control" type="file" name="postImg[]" id="postImg" style="display: none;" multiple>
                <label class="img-fluid" for="postImg">
                    @php
                        $images = json_decode($post->image, true) ?? [];
                    @endphp
                    @foreach ($images as $image)
                        <img class="img-fluid" src="/images/posts/{{ $image }}" alt="Image" width="200">
                    @endforeach
                </label>
            </div>
            <input class="btn btn-primary" type="submit" value="SEND">
        </form>
    </div>
@endsection
