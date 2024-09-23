<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Clients\BaseClient;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use Illuminate\Support\Facades\Http;

it('throws PolarApiUnprocessableEntityException on 422 status', function (): void {
    Http::fake([
        '*' => Http::response([
            'detail' => [
                [
                    'loc'  => ['string'],
                    'msg'  => 'string',
                    'type' => 'string',
                ],
            ],
        ], 422),
    ]);

    $client = new BaseClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->request(method: 'get', endpoint: '/endpoint');
});

it('throws PolarApiNotFoundException on 404 status', function (): void {
    Http::fake([
        '*' => Http::response([
            'type'   => 'ResourceNotFound',
            'detail' => 'string',
        ], 404),
    ]);

    $client = new BaseClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiNotFoundException::class);
    $this->expectExceptionMessage('Resource Not Found');

    $client->request(method: 'get', endpoint: '/endpoint');
});

it('returns response array on successful request', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'value'], 200),
    ]);

    $client = new BaseClient(baseUrl: '*', token: 'string');

    $response = $client->request(method: 'get', endpoint: '/endpoint');

    expect($response)->toBe(['data' => 'value']);
});
