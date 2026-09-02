<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class SecurityHeadersAndRateLimitTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        RateLimiter::clear('auth|127.0.0.1');
        RateLimiter::clear('forgot-password|127.0.0.1');
    }

    /**
     * HTTP Security Headers Verification (OWASP Secure Headers).
     */
    public function test_global_security_headers_are_present(): void
    {
        $response = $this->get('/');

        // 1. Frame Options (Clickjacking Mitigation)
        $response->assertHeader('X-Frame-Options', 'DENY');

        // 2. MIME Sniffing Blocker
        $response->assertHeader('X-Content-Type-Options', 'nosniff');

        // 3. Referrer Policy
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 4. Content Security Policy
        $this->assertTrue($response->headers->has('Content-Security-Policy'));

        // 5. Tech Stack Fingerprint Removal
        $this->assertFalse($response->headers->has('X-Powered-By'));
        $this->assertFalse($response->headers->has('Server'));
    }

    /**
     * Rate Limiting: Forgot password endpoint throttles excessive requests.
     */
    public function test_forgot_password_rate_limiting(): void
    {
        // Limit is 3 per 10 minutes
        for ($i = 0; $i < 3; $i++) {
            $this->post('/forgot-password', ['email' => 'test@example.com']);
        }

        // 4th request must be throttled with HTTP 429
        $response = $this->post('/forgot-password', ['email' => 'test@example.com']);
        $response->assertStatus(429);
    }

    /**
     * Rate Limiting: Login endpoint throttles brute force attempts.
     */
    public function test_login_rate_limiting(): void
    {
        // Limit is 5 per minute
        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', [
                'username' => 'invalid_user',
                'password' => 'wrong_pass',
            ]);
        }

        // 6th request must be throttled with HTTP 429
        $response = $this->post('/login', [
            'username' => 'invalid_user',
            'password' => 'wrong_pass',
        ]);

        $response->assertStatus(429);
    }
}
