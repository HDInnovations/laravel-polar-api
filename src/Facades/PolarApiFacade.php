<?php

namespace HDInnovations\LaravelPolarApi\Facades;

use Illuminate\Support\Facades\Facade;

class PolarApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-polar-api';
    }
}
