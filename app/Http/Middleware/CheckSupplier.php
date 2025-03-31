<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSupplier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('usr_type') !== 'supplier') {
            abort(403, 'Unauthorized access');
        }
        return $next($request);
/*        
        if (auth()->check() && auth()->user()->role === 'supplier') {
            return $next($request);
        }
        return redirect('/')->with('error', 'Supplier access only');
*/        
    }
}
