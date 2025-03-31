<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('usr_type') !== 'customer') {
            abort(403, 'Unauthorized access');
        }
        return $next($request);
/*        
        if (auth()->check() && auth()->user()->role === 'customer') {
            return $next($request);
        }
        return redirect('/supplier/dashboard')->with('error', 'Customer access only');
*/
    }
}
