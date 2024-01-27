<!-- resources/views/comments/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>All Comments</h1>

    @foreach($comments as $comment)
        <div>
            <p>{{ $comment->body }}</p>
            <p>By: {{ $comment->user->name }}</p>
            <p>At: {{ $comment->created_at }}</p>
        </div>
        <hr>
    @endforeach
@endsection
