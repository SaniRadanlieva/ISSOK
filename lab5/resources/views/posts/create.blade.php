<!-- resources/views/posts/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Create a New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <label for="body">Body:</label>
        <textarea name="body" rows="5" required></textarea>
        <button type="submit">Create Post</button>
    </form>
@endsection
