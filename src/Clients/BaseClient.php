<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Clients;

use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use Illuminate\Support\Facades\Http;
use JsonException;

class BaseClient
{
    public function __construct(private readonly string $baseUrl, private readonly string $token)
    {
    }

    /**
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     * @throws JsonException
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

        if ($response->getStatusCode() === 404) {
            $responseBody = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            throw new PolarApiNotFoundException($responseBody);
        }

        return $response->json();
    }
}
