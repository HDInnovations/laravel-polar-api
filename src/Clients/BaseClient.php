<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Clients;

use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use Illuminate\Support\Facades\Http;

class BaseClient
{
    public function __construct(private readonly string $baseUrl, private readonly string $token)
    {
    }

    /**
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     */
    final public function request(string $method, string $endpoint, array $params = []): array
    {
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer '.$this->token,
        ])->$method($this->baseUrl.$endpoint, $params);

        if ($response->status() === 422) {
            throw new PolarApiUnprocessableEntityException($response->json('detail'));
        }

        if ($response->status() === 404) {
            throw new PolarApiNotFoundException($response->json('detail'));
        }

        return $response->json();
    }
}
