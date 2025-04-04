<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if (!Auth::guard($guard)->check()) {
                return redirect()->route('login');
            }
        }

        return $next($request);
    }

    // Redirect to /login if unauthorized
    protected function redirectTo($request)
    {
        return route('login');
    }
}