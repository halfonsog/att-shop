<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Check if user is admin
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session('usr_type') !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}