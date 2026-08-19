<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        if (app()->environment('production')) {
            $csp = "default-src 'self'; "
                 ."script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com; "
                 ."style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; "
                 ."font-src 'self' https://fonts.gstatic.com; "
                 ."img-src 'self' data: https:; "
                 ."connect-src 'self';";
            $response->headers->set('Content-Security-Policy', $csp);
        }

        return $response;
    }
}
