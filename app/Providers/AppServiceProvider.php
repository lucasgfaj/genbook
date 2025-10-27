<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Vite;

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
        if (app()->environment('testing')) {
              app()->bind(Vite::class, function () {
                return new class {
                    public function __invoke($asset)
                    {
                        return '';
                    }
                    public function asset($path)
                    {
                        return '';
                    }
                };
              });
        }
    }
}
