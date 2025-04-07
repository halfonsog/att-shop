<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Session timeout (1 hour)
        $lastActivity = session('last_activity', 0);
        if (now()->timestamp - $lastActivity > 3600) {
            session()->flush();
            return redirect('/login')->with('error', 'Su sesión ha expirado');
        }
        session(['last_activity' => now()->timestamp]);

        // General auth check
        if (!session('auth')) {
            return redirect('/login')->with('error', 'Acceso restringido. Regístrese');
        }

        return $next($request);
    }
}