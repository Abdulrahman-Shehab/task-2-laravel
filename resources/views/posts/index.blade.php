@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <a href="{{ route('posts.create') }}" class="btn btn-primary mt-4 ml-4">Add New Post</a>
    <hr>
    <div class="container text-center">
        <div class="row gy-5">
            @forelse ($posts as $post)
                <div class="col-6">
                    <div class="p-3">
                        @php
                            $images = json_decode($post->image, true) ?? [];
                        @endphp
                        @if (is_array($images))
                            @foreach ($images as $image)
                                <img class="img-fluid" src="/images/posts/{{ $image }}" alt="Image" width="200">
                            @endforeach
                        @else
                            <p>No images available.</p>
                        @endif
                        <h1 class="">{{ $post->title }}</h1>
                        <p class="">{{ $post->description }}</p>
                        <a class="btn btn-secondary mb-1" href="{{ route('posts.show', $post->id) }}">Read More..</a>
                        <a class="btn btn-secondary mb-1" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger mb-1" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <h1>There Is No Posts</h1>
            @endforelse
        </div>
    </div>
@endsection
