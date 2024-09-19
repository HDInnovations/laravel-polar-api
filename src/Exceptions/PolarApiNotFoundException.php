<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Exceptions;

use Exception;

class PolarApiNotFoundException extends Exception
{
    protected string $type;

    protected string $detail;

    public function __construct(string $detail, $message = 'Resource Not Found', $code = 404, ?Exception $previous = null)
    {
        $this->type = 'ResourceNotFound';
        $this->detail = $detail;
        parent::__construct($message, $code, $previous);
    }

    final public function getType(): string
    {
        return $this->type;
    }

    final public function getDetail(): string
    {
        return $this->detail;
    }

    final public function toArray(): array
    {
        return [
            'type' => $this->type,
            'detail' => $this->detail,
        ];
    }
}
