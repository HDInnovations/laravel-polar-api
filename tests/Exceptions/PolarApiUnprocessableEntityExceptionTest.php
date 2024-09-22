<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;

it('parses and returns the 422 response correctly', function (): void {
    $details = [
        'field' => 'error message',
    ];

    $exception = new PolarApiUnprocessableEntityException($details);

    expect($exception->getDetails())->toBe($details)
        ->and($exception->getMessage())->toBe('Unprocessable Entity')
        ->and($exception->getCode())->toBe(422);
});
