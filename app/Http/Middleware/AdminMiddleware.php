<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        $auth = session('auth');
        
        // 1. Check if authenticated
        if (!$auth) {
            return redirect('/login')->with('error', 'Aceso restringido. Autentiquese');
        }

        if (!str_ends_with(session('auth.role'), 'admin')) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}