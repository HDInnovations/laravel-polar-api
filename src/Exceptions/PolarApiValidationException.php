<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Exceptions;

use Exception;

class PolarApiValidationException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
