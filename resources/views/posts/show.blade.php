@extends('layouts.app')

@section('title', 'post')

@section('content')
    <a class="btn btn-primary mt-4 ml-4" href="{{ route('posts.index') }}">back</a>
    <hr>
    <div class="container">
        <div class="card mb-3">
            @php
                $images = json_decode($post->image, true) ?? [];
            @endphp
            @foreach ($images as $image)
                <img class="img-fluid" src="/images/posts/{{ $image }}" alt="Image" >
            @endforeach
            <div class="card-body">
                <h1 class="card-title">{{ $post->title }}</h1>
                <p class="card-text">{{ $post->description }}</p>
                <p class="card-text"><small class="text-body-secondary">added at : {{ $post->created_at }}</small></p>
            </div>
        </div>
    </div>

@endsection