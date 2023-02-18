<?php

namespace App\Providers;

use App\Services\PermissionsService;
use App\Services\RconService;
use App\Services\SettingsService;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \Illuminate\Foundation\Vite::class,
            \App\Services\ViteService::class
        );

        $this->app->singleton(
            SettingsService::class,
            fn () => new SettingsService()
        );

        $this->app->singleton(
            RconService::class,
            fn () => new RconService()
        );

        $this->app->singleton(
            PermissionsService::class,
            fn () => new PermissionsService()
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::registerNavigationGroups([
            'Users',
            'Content'
        ]);

        if (config('habbo.site.force_https')) {
            URL::forceScheme('https');
        }
    }
}
