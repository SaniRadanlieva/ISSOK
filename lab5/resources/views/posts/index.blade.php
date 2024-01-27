<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>All Posts</h1>

    @foreach($posts as $post)
        <div>
            <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
            <p>{{ $post->body }}</p>
{{--            @if($post->author)--}}
{{--                <p>Author: {{ $post->author->name }}</p>--}}
{{--            @else--}}
{{--                <p>Author: N/A</p>--}}
{{--            @endif--}}
            <p>Author: {{ $post->role ? $post->user : 'Anonymous' }}</p>

{{--            <p>Published on: {{ $post->published_on }}</p>--}}
        </div>
        <hr>
    @endforeach

    <!-- Move the "Create New Post" button outside the loop -->
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
@endsection
