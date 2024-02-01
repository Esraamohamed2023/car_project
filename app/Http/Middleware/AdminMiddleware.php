<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
 

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->admin == 1) {
            return $next($request);
        }
    
        abort(403, 'You are not authorized to access this resource as an admin.');
    }
    
}
