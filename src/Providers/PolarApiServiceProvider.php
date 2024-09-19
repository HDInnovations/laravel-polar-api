<?php

namespace HDInnovations\LaravelPolarApi\Providers;

use HDInnovations\LaravelPolarApi\Facades\PolarApiFacade;
use Illuminate\Support\ServiceProvider;

class PolarApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
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
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'polar-api');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-polar-api', function () {
            return new PolarApiFacade;
        });
    }
}
