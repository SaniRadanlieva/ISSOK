<!-- resources/views/comments/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Comment</h1>
    <p>{{ $comment->body }}</p>
    <p>By: {{ $comment->user->name }}</p>
    <p>At: {{ $comment->created_at }}</p>
@endsection
