<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Clients\ProductClient;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiValidationException;
use Illuminate\Support\Facades\Http;

it('gets products successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'products'], 200),
    ]);

    $client = new ProductClient('*', 'string');

    $response = $client->getProducts('org-id');

    expect($response)->toBe(['data' => 'products']);
});

it('throws PolarApiValidationException when organization_id is missing', function (): void {
    $client = new ProductClient('*', 'string');

    $this->expectException(PolarApiValidationException::class);
    $this->expectExceptionMessage('The organization_id parameter is required.');

    $client->getProducts();
});

it('throws PolarApiUnprocessableEntityException on 422 status when getting products', function (): void {
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

    $client = new ProductClient('*', 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->getProducts('org-id');
});

it('throws PolarApiNotFoundException on 404 status when getting product by ID', function (): void {
    Http::fake([
        '*' => Http::response([
            'type'   => 'ResourceNotFound',
            'detail' => 'string',
        ], 404),
    ]);

    $client = new ProductClient('*', 'string');

    $this->expectException(PolarApiNotFoundException::class);
    $this->expectExceptionMessage('Resource Not Found');

    $client->getProductById('1');
});

it('gets product by ID successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'product'], 200),
    ]);

    $client = new ProductClient('*', 'string');

    $response = $client->getProductById('1');

    expect($response)->toBe(['data' => 'product']);
});
