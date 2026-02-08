<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

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
        // 1. Keeps your Bootstrap 5 styling for pagination
        Paginator::useBootstrapFive();

        // 2. Forces HTTPS for all links and forms when on Railway/Production
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}