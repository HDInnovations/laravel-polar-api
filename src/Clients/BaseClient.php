<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Clients;

use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use Illuminate\Support\Facades\Http;

class BaseClient
{
    private string $baseUrl;

    private string $token;

    public function __construct(string $baseUrl, string $token)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
    }

    /**
     * @throws \HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException
     * @throws \HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException
     */
    final public function request(string $method, string $endpoint, array $params = []): array
    {
        $response = Http::withToken($this->token)->$method($this->baseUrl . $endpoint, $params);

        if ($response->status() === 422) {
            throw new PolarApiUnprocessableEntityException($response->json('detail'));
        }

        if ($response->status() === 404) {
            throw new PolarApiNotFoundException($response->json('detail'));
        }

        return $response->json();
    }
}
