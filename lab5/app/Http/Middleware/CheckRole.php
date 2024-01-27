<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        $user = auth()->user();

        switch ($role) {
            case 'admin':
                if (!$user->isAdmin()) {
                    abort(403, 'Unauthorized action.');
                }
                break;

            case 'author':
                if (!$user->isAuthor()) {
                    abort(403, 'Unauthorized action.');
                }
                break;

            case 'subscriber':
                if (!$user->isSubscriber()) {
                    abort(403, 'Unauthorized action.');
                }
                break;

            default:
                abort(403, 'Invalid role specified.');
        }

        return $next($request);
    }
}
