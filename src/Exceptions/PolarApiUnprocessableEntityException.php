<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Exceptions;

use Exception;

class PolarApiUnprocessableEntityException extends Exception
{
    protected array $details;

    public function __construct(array $details, string $message = 'Unprocessable Entity', int $code = 422, ?Exception $previous = null)
    {
        $this->details = $details;
        parent::__construct($message, $code, $previous);
    }

    final public function getDetails(): array
    {
        return $this->details;
    }
}
