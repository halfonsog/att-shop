<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AuthService;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $authService = app(AuthService::class);
    
        if (!$authService->isLoggedIn($role)) {
            return redirect('/login');
        }
        // Check if user has the required role
        if (!$authService->verifyUserRole($role)) {
            $authService->logout();
            return redirect('/login')->with('error', 'Credenciales inválidas');
       }

        return $next($request);
    }
}