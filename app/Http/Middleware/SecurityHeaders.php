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

        // Menghapus header yang menginformasikan teknologi server
        $response->headers->remove('X-Powered-By');

        // Security Headers dasar
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=(), payment=()');

        // Hanya terapkan HSTS dan CSP ketat di environment production
        if (app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

            // CSP ketat untuk production
            $csp = "default-src 'self'; "
                 ."script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com https://unpkg.com; "
                 ."style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; "
                 ."font-src 'self' https://fonts.gstatic.com; "
                 ."img-src 'self' data: https: blob:; "
                 ."connect-src 'self' https://api.groq.com https://unpkg.com wss:; "
                 ."worker-src 'self' blob:; "
                 ."object-src 'none'; "
                 ."frame-src 'self' https://www.google.com;";

            $response->headers->set('Content-Security-Policy', $csp);
        } else {
            // Untuk local development (Vite dkk), kita buat CSP longgar agar Vite port 5173 tidak terblokir
            $csp = "default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob: http: https: ws: wss:;";
            $response->headers->set('Content-Security-Policy', $csp);
        }

        return $response;
    }
}
