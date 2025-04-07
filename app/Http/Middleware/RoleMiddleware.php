<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Check if user has the required role
        if (session('auth.role') !== $role) {
            abort(403, 'No tiene acceso a esta área');
        }
        
        // Additional validation against database (recommended)
        $user = DB::table('users')
                ->where('id', session('auth.user_id'))
                ->where('role', $role)
                ->first();
                
        if (!$user) {
            session()->forget('auth');
            return redirect('/login')->with('error', 'Credenciales inválidas');
        }

        return $next($request);
    }
}