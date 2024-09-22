<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Exceptions\PolarApiValidationException;

it('parses and returns the validation error message correctly', function (): void {
    $message = 'Validation error occurred';

    $exception = new PolarApiValidationException($message);

    expect($exception->getMessage())->toBe($message);
});
