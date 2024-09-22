<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;

it('parses and returns the 404 response correctly', function (): void {
    $response = [
        'type'   => 'ResourceNotFound',
        'detail' => 'The requested resource was not found.',
    ];

    $exception = new PolarApiNotFoundException($response);

    expect($exception->getType())->toBe('ResourceNotFound')
        ->and($exception->getDetail())->toBe('The requested resource was not found.')
        ->and($exception->toArray())->toBe($response);
});
