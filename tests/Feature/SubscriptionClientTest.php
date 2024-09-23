<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Clients\SubscriptionClient;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use Illuminate\Support\Facades\Http;

it('gets subscriptions successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'subscriptions'], 200),
    ]);

    $client = new SubscriptionClient(baseUrl: '*', token: 'string');

    $response = $client->getSubscriptions(organizationId: 'org-id');

    expect($response)->toBe(['data' => 'subscriptions']);
});

it('throws PolarApiUnprocessableEntityException on 422 status when getting subscriptions', function (): void {
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

    $client = new SubscriptionClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->getSubscriptions(organizationId: 'org-id');
});
