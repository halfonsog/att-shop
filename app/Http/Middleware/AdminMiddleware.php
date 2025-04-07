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

    // Session timeout check (1 hour)
    $lastActivity = session('last_activity') ?? 0;
    if (time() - $lastActivity > 3600) {
        session_unset();
        return redirect('/login')->with('error', 'Su sesión ha expiredo');
    }
    session(['last_activity' => time()]);

    // Auth check
    if (empty(session('auth'))) {
        return redirect('/login')->with('error', 'Acceso restringido. Regístrese');
    }

    // Role check
    if (session('auth.role') !==  'admin') {
        abort(403, 'Acceso restringido a los administradores');
    }

    return $next($request);
  }
}