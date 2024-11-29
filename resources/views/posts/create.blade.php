@extends('layouts.app')

@section('title', 'Add Post')

@section('content')
    <div class="container">
        <h1 class="title">Add New Post</h1>
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="postTitle">Post Title : </label>
                <input class="form-control" type="text" name="title" id="postTitle">
            </div>
            <div class="mb-3">
                <label for="postDes" class="form-label">Post Description</label>
                <textarea class="form-control" id="postDes" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="postImg" class="form-label">Choose Images : </label>
                <input class="form-control" type="file" name="postImg[]" id="postImg" multiple>
            </div>
            <input class="btn btn-primary" type="submit" value="SEND">
        </form>
    </div>
@endsection
