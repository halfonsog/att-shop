<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyCSP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Basic CSP Policy (customize as needed)
        $cspPolicy = implode('; ', [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline'", // Required for Laravel Mix/Vite
            "style-src 'self' 'unsafe-inline'",
            "img-src 'self' data:",
            "font-src 'self'",
            "connect-src 'self'", // Blocks external calls like aitoria.ai
            "frame-src 'none'",
            "object-src 'none'"
        ]);

        $response->headers->set(
            'Content-Security-Policy', 
            $cspPolicy,
            true // Replace existing headers
        );

        // For reporting mode (temporary during development)
        // $response->headers->set('Content-Security-Policy-Report-Only', $cspPolicy);

        return $response;
    }
}