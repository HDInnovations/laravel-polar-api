<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Clients\ArticleClient;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotPermittedException;
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

it('posts an article successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'article'], 201),
    ]);

    $client = new ArticleClient('*', 'string');

    $response = $client->postArticle(
        'Test Title',
        'Test Body',
        'org-123',
        'public',
        false,
        false,
        false
    );

    expect($response)->toBe(['data' => 'article']);
});

it('updates an article successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'updated article'], 200),
    ]);

    $client = new ArticleClient('*', 'string');

    $response = $client->updateArticle(
        '1',
        'Updated Title',
        'Updated Body',
        'private',
        true,
        true,
        true
    );

    expect($response)->toBe(['data' => 'updated article']);
});

it('deletes an article successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'deleted article'], 200),
    ]);

    $client = new ArticleClient('*', 'string');

    $response = $client->deleteArticle('1');

    expect($response)->toBe(['data' => 'deleted article']);
});

it('throws PolarApiNotPermittedException on 403 status when deleting article', function (): void {
    Http::fake([
        '*' => Http::response([
            'type'   => 'NotPermitted',
            'detail' => 'string',
        ], 403),
    ]);

    $client = new ArticleClient('*', 'string');

    $this->expectException(PolarApiNotPermittedException::class);
    $this->expectExceptionMessage('Not Permitted');

    $client->deleteArticle('1');
});
