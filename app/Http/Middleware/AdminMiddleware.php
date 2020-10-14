<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if (auth()->user()->isAdmin == 0) {
            return redirect('/dashboard')->with('error', 'Unauthorized Access!. Please Login as an Admin');
        }
        return $next($request);
    }
}
