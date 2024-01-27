<?php
// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
use HasFactory;

protected $fillable = ['title', 'author', 'body', 'slug', 'published_on', 'last_modified', 'active'];

protected $guarded = ['id'];

public function author()
{
return $this->belongsTo(User::class, 'author');
}

public function comments()
{
return $this->hasMany(Comment::class, 'on_post');
}
}
