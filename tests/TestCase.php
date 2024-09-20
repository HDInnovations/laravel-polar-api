<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Tests;

use HDInnovations\LaravelPolarApi\Providers\PolarApiServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            PolarApiServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
    }
}
