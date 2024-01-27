<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:edit-post,post')->only('edit', 'update');
        $this->middleware('check-role:admin')->only('adminFunction'); // Adjust the method name as needed
    }

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = new Post([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'author' => auth()->author(), // Assuming you want to associate the post with the authenticated user
        ]);

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);



        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $comment = new Comment([
            'body' => $request->input('body'),
            'from_user' => auth()->id(),
        ]);

        $post->comments()->save($comment);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully');
    }

    public function destroyComment(Comment $comment)
    {
        $this->authorize('delete-comment', $comment);

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }

    // New method for role-specific functionality
    public function adminFunction()
    {
        // Functionality for admin only
    }
}
