<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Clients\CheckoutClient;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use Illuminate\Support\Facades\Http;

it('creates a checkout successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'checkout'], 201),
    ]);

    $client = new CheckoutClient(baseUrl: '*', token: 'string');

    $response = $client->createCheckout(
        productPriceId: 'price-id',
        successUrl: 'https://example.com/success',
        customerEmail: 'customer@example.com'
    );

    expect($response)->toBe(['data' => 'checkout']);
});

it('throws PolarApiUnprocessableEntityException on 422 status when creating checkout', function (): void {
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

    $client = new CheckoutClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->createCheckout(
        productPriceId: 'price-id',
        successUrl: 'https://example.com/success',
        customerEmail: 'customer@example.com'
    );
});

it('gets checkout by ID successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'checkout'], 200),
    ]);

    $client = new CheckoutClient(baseUrl: '*', token: 'string');

    $response = $client->getCheckoutById(checkoutId: '1');

    expect($response)->toBe(['data' => 'checkout']);
});

it('throws PolarApiUnprocessableEntityException on 422 status when getting checkout by ID', function (): void {
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

    $client = new CheckoutClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->getCheckoutById(checkoutId: '1');
});