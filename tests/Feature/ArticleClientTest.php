<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Clients\ArticleClient;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use Illuminate\Support\Facades\Http;

it('gets articles successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'articles'], 200),
    ]);

    $client = new ArticleClient('*', 'string');

    $response = $client->getArticles();

    expect($response)->toBe(['data' => 'articles']);
});

it('throws PolarApiUnprocessableEntityException on 422 status when getting articles', function (): void {
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

    $client = new ArticleClient('*', 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->getArticles();
});

it('gets article by ID successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'article'], 200),
    ]);

    $client = new ArticleClient('*', 'string');

    $response = $client->getArticleById('1');

    expect($response)->toBe(['data' => 'article']);
});

it('throws PolarApiUnprocessableEntityException on 422 status when getting article by ID', function (): void {
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

    $client = new ArticleClient('*', 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->getArticleById('1');
});

it('throws PolarApiNotFoundException on 404 status when getting article by ID', function (): void {
    Http::fake([
        '*' => Http::response([
            'type'   => 'ResourceNotFound',
            'detail' => 'string',
        ], 404),
    ]);

    $client = new ArticleClient('*', 'string');

    $this->expectException(PolarApiNotFoundException::class);
    $this->expectExceptionMessage('Resource Not Found');

    $client->getArticleById('1');
});

it('gets article receivers count successfully', function (): void {
    Http::fake([
        '*' => Http::response([
            'free_subscribers'     => 10,
            'premium_subscribers'  => 5,
            'organization_members' => 3,
        ], 200),
    ]);

    $client = new ArticleClient('*', 'string');

    $response = $client->getArticleReceiversCount('1');

    expect($response)->toBe([
        'free_subscribers'     => 10,
        'premium_subscribers'  => 5,
        'organization_members' => 3,
    ]);
});

it('throws PolarApiUnprocessableEntityException on 422 status when getting article receivers count', function (): void {
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

    $client = new ArticleClient('*', 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->getArticleReceiversCount('1');
});
