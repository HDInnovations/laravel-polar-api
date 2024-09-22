<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotPermittedException;

it('parses and returns the 403 response correctly', function (): void {
    $response = [
        'type'   => 'NotPermitted',
        'detail' => 'string',
    ];

    $exception = new PolarApiNotPermittedException($response);

    expect($exception->getType())->toBe('NotPermitted')
        ->and($exception->getDetail())->toBe('string')
        ->and($exception->getMessage())->toBe('Not Permitted')
        ->and($exception->getCode())->toBe(403)
        ->and($exception->toArray())->toBe($response);
});
