<?php

namespace LucasQuinnGuru\LaravelUser\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->hasPermissionTo('Administer')) { //If user has this //permission
            return $next($request);
        }

        if ($request->is('posts/create')) { //If user is creating a post
            if (!Auth::user()->hasPermissionTo('Add Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('posts/*/edit')) { //If user is editing a post
            if (!Auth::user()->hasPermissionTo('Edit Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) { //If user is deleting a post
            if (!Auth::user()->hasPermissionTo('Delete Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
