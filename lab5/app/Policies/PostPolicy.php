<?php
// File: app/Policies/PostPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    public function update(User $user, Post $post)
    {
        // Allow any user to update any post
        return true;
    }

    public function delete(User $user, Post $post)
    {
        // Allow any user to delete any post
        return true;
    }
}
