<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Providers\PolarApiServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

it('publishes the configuration file successfully', function (): void {
    $this->artisan('vendor:publish', ['--provider' => PolarApiServiceProvider::class, '--tag' => 'config'])
        ->assertExitCode(0);

    $publishedConfigPath = config_path('polar-api.php');
    expect(File::exists($publishedConfigPath))->toBeTrue();
});

it('merges the configuration file correctly', function (): void {
    $serviceProvider = new PolarApiServiceProvider($this->app);
    $serviceProvider->register();

    expect(Config::get('polar-api'))->not->toBeNull();
});

it('registers the facade properly', function (): void {
    $serviceProvider = new PolarApiServiceProvider($this->app);
    $serviceProvider->register();

    expect($this->app->bound('laravel-polar-api'))->toBeTrue();
});
