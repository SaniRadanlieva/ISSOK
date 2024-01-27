<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Resourceful routes for posts
Route::resource('posts', PostController::class);

// Routes for comments
Route::post('posts/{post}/comment', [PostController::class, 'storeComment'])->name('posts.comment.store');
Route::delete('comments/{comment}', [PostController::class, 'destroyComment'])->name('comments.destroy');
// web.php
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
// routes/web.php

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

// routes/web.php

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
// routes/web.php

// In your routes/web.php
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

