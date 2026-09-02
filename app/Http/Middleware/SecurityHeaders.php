<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        // Generate random CSP nonce for this request lifecycle
        $nonce = Str::random(32);
        app()->instance('csp-nonce', $nonce);

        $response = $next($request);

        // 1. Remove Server Technology Fingerprint
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        // 2. Anti-Clickjacking Header (Strict DENY)
        $response->headers->set('X-Frame-Options', 'DENY');

        // 3. MIME Sniffing Blocker
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // 4. Strict Referrer Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 5. Cross-Origin Policies (COOP, CORP)
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
        $response->headers->set('Cross-Origin-Resource-Policy', 'same-origin');

        // 6. Permissions Policy
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=(), payment=()');

        // 7. Strict-Transport-Security (HSTS)
        if (! app()->environment('local')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // 8. Content-Security-Policy (CSP)
        if (app()->environment('production')) {
            $csp = "default-src 'self'; "
                 ."script-src 'self' 'nonce-{$nonce}' 'unsafe-eval' https://cdn.tailwindcss.com https://unpkg.com; "
                 ."style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; "
                 ."font-src 'self' https://fonts.gstatic.com; "
                 ."img-src 'self' data: https: blob:; "
                 ."connect-src 'self' https://api.groq.com https://unpkg.com wss:; "
                 ."worker-src 'self' blob:; "
                 ."object-src 'none'; "
                 ."frame-src 'self' https://www.google.com;";

            $response->headers->set('Content-Security-Policy', $csp);
        } else {
            // Local & testing CSP
            $csp = "default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob: http: https: ws: wss:;";
            $response->headers->set('Content-Security-Policy', $csp);
        }

        return $response;
    }
}
