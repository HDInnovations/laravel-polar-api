<?php

namespace HDInnovations\LaravelPolarApi\Exceptions;

use Exception;

class PolarApiUnprocessableEntityException extends Exception
{
    protected array $details;

    public function __construct(array $details, $message = 'Unprocessable Entity', $code = 422, ?Exception $previous = null)
    {
        $this->details = $details;
        parent::__construct($message, $code, $previous);
    }

    final public function getDetails(): array
    {
        return $this->details;
    }

    final public function toArray(): array
    {
        return [
            'detail' => $this->details,
        ];
    }
}
