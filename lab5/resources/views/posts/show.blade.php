<!-- resources/views/posts/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <p> Author: {{ $post->name ? $post->user : 'Anonymous' }} </p>
    {{-- <p>Published on: {{ $post->published_on }}</p> --}}


        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit Post</a>



        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Post</button>
        </form>


    <h2>Comments</h2>
    @foreach($post->comments as $comment)
        <div>
            <p>{{ $comment->body }}</p>
            <p>By: {{ $comment->from_user }}</p>
            {{-- <p>At: {{ $comment->created_at }}</p> --}}
            @can('delete-comment', $comment)
                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Comment</button>
                </form>
            @endcan
        </div>
        <hr>
    @endforeach

    @auth
        <h2>Add a Comment</h2>
        <form action="{{ route('posts.comment.store', $post) }}" method="POST">
            @csrf
            <textarea name="body" rows="3" required></textarea>
            <button type="submit">Add Comment</button>
        </form>
    @endauth
@endsection
