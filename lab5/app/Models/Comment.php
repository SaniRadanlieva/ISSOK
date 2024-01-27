<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['body', 'from_user'];
    public function post()
    {
        return $this->belongsTo(Post::class, 'on_post');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'from_user');
    }
}
