<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Facades\PolarApiFacade;

it('returns the correct facade accessor', function (): void {
    expect(PolarApiFacade::getFacadeAccessor())->toBe('laravel-polar-api');
});
