<?php

namespace App\Providers;

use App\Auth\EncryptedEmailUserProvider;
use App\Models\Laporan;
use App\Policies\LaporanPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ── 0. Auth provider: supports email terenkripsi (blind index) ────────
        Auth::provider('eloquent-encrypted-email', function ($app, array $config) {
            return new EncryptedEmailUserProvider($app['hash'], $config['model']);
        });

        // ── 1. Strict Password Rules ──────────────────────────────────────────
        Password::defaults(function () {
            $rule = Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols();

            return app()->environment('production')
                ? $rule->uncompromised(3)
                : $rule;
        });

        // ── 2. Strict Database Security & Performance ─────────────────────────
        Model::preventLazyLoading(! app()->isProduction());
        Model::preventSilentlyDiscardingAttributes(! app()->isProduction());
        Model::preventAccessingMissingAttributes(! app()->isProduction());

        // ── 3. Force HTTPS in Production to prevent MITM attacks ──────────────
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // ── 4. Long-running Query Monitor (DDoS/Performance) ─────────────────
        // Bindings are intentionally omitted to prevent PII leakage into logs.
        DB::whenQueryingForLongerThan(500, function (\Illuminate\Database\Connection $connection, \Illuminate\Database\Events\QueryExecuted $event) {
            Log::warning('Long-running query detected ('.$event->time.'ms)', [
                'sql' => $event->sql,
            ]);
        });

        // ── 5. Policy Registration — Defense in Depth: Authorization Layer ────
        //
        // Maps the Laporan model to LaporanPolicy. Laravel's Gate will
        // automatically consult this policy for any authorize() call on Laporan.
        //
        // This is the single authoritative IDOR defence:
        //   Gate::authorize('downloadPoc', $laporan) → LaporanPolicy::downloadPoc()
        //   Gate::authorize('update', $laporan)      → LaporanPolicy::update()
        Gate::policy(Laporan::class, LaporanPolicy::class);

        // ── 6. Named Rate Limiters — Defense in Depth: Network/Edge Layer ─────
        //
        // Named limiters decouple the throttle logic from route definitions.
        // They are referenced in routes as ->middleware('throttle:limiter-name').
        //
        // auth: 5 attempts/minute per IP. Used on POST /login & POST /register.
        RateLimiter::for('auth', function (Request $request) {
            return Limit::perMinute(5)
                ->by($request->ip())
                ->response(function (Request $request, array $headers) {
                    return response()->json([
                        'message'     => 'Terlalu banyak percobaan. Silakan coba lagi dalam beberapa menit.',
                        'retry_after' => $headers['Retry-After'] ?? 60,
                    ], 429, $headers);
                });
        });

        // forgot-password: 3 attempts/10 minutes per IP — stricter to prevent
        // enumeration attacks on the password reset flow.
        RateLimiter::for('forgot-password', function (Request $request) {
            return Limit::perMinutes(10, 3)
                ->by($request->ip())
                ->response(function (Request $request, array $headers) {
                    return response()->json([
                        'message'     => 'Terlalu banyak permintaan reset. Silakan coba lagi nanti.',
                        'retry_after' => $headers['Retry-After'] ?? 600,
                    ], 429, $headers);
                });
        });

        // submission: 3 reports/60 minutes per user (falls back to IP for
        // guests, though the route already requires auth+hunter role).
        RateLimiter::for('submission', function (Request $request) {
            $key = $request->user()?->id
                ? 'user:'.$request->user()->id
                : 'ip:'.$request->ip();

            return Limit::perHour(3)
                ->by($key)
                ->response(function (Request $request, array $headers) {
                    return response()->json([
                        'message'     => 'Batas pengiriman laporan tercapai. Anda dapat mengirim maksimal 3 laporan per jam.',
                        'retry_after' => $headers['Retry-After'] ?? 3600,
                    ], 429, $headers);
                });
        });
    }
}
