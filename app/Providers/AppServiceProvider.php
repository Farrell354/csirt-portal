<?php

namespace App\Providers;

use App\Auth\EncryptedEmailUserProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        // 0. Auth provider dengan dukungan email terenkripsi (blind index)
        Auth::provider('eloquent-encrypted-email', function ($app, array $config) {
            return new EncryptedEmailUserProvider($app['hash'], $config['model']);
        });

        // 1. Strict Password Rules
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

        // 2. Strict Database Security & Performance
        Model::preventLazyLoading(! app()->isProduction());
        Model::preventSilentlyDiscardingAttributes(! app()->isProduction());
        Model::preventAccessingMissingAttributes(! app()->isProduction());

        // 3. Force HTTPS in Production to prevent MITM attacks
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // 4. Log Long-Running Queries (DDoS/Performance monitoring)
        // Bindings tidak dicatat agar data pribadi tidak masuk ke log
        DB::whenQueryingForLongerThan(500, function ($connection, $event) {
            Log::warning("Long-running query detected ({$event->queryTime}ms)", [
                'sql' => $event->sql,
            ]);
        });
    }
}
