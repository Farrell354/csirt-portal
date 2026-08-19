<?php

namespace App\Providers;

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
        // 1. Password Complexity Rules (NIST Standards)
        Password::defaults(function () {
            $rule = Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols();

            return app()->environment('production')
                ? $rule->uncompromised(3) // Cegah penggunaan password yang pernah bocor
                : $rule;
        });

        // 2. Force HTTPS in Production to prevent MITM attacks
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
