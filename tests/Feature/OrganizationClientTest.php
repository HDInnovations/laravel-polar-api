<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Clients\OrganizationClient;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiValidationException;
use Illuminate\Support\Facades\Http;

it('gets organizations successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'organizations'], 200),
    ]);

    $client = new OrganizationClient(baseUrl: '*', token: 'string');

    $response = $client->getOrganizations(slug: 'slug', isMember: true);

    expect($response)->toBe(['data' => 'organizations']);
});

it('throws PolarApiValidationException when both slug and isMember are null', function (): void {
    $client = new OrganizationClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiValidationException::class);
    $this->expectExceptionMessage('Either slug or isMember must be provided.');

    $client->getOrganizations(slug: null, isMember: null);
});

it('throws PolarApiUnprocessableEntityException on 422 status when getting organizations', function (): void {
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

    $client = new OrganizationClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->getOrganizations(slug: 'slug', isMember: true);
});

it('gets an organization by its ID successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'organization'], 200),
    ]);

    $client = new OrganizationClient(baseUrl: '*', token: 'string');

    $response = $client->getOrganizationById(organizationId: 'org-id');

    expect($response)->toBe(['data' => 'organization']);
});

it('throws PolarApiUnprocessableEntityException on 422 status when getting an organization by its ID', function (): void {
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

    $client = new OrganizationClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->getOrganizationById(organizationId: 'org-id');
});

it('throws PolarApiNotFountException on 404 status when getting an organization by its ID', function (): void {
    Http::fake([
        '*' => Http::response([
            'type'   => 'ResourceNotFound',
            'detail' => 'string',
        ], 404),
    ]);

    $client = new OrganizationClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiNotFoundException::class);
    $this->expectExceptionMessage('Resource Not Found');

    $client->getOrganizationById(organizationId: 'org-id');
});
