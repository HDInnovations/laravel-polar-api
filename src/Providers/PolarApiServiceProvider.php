<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Providers;

use HDInnovations\LaravelPolarApi\Facades\PolarApiFacade;
use Illuminate\Support\ServiceProvider;

class PolarApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/config.php' => config_path('polar-api.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'polar-api');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-polar-api', fn () => new PolarApiFacade());
    }
}
