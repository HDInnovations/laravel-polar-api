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

    $client = new ArticleClient(baseUrl: '*', token: 'string');

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

    $client = new ArticleClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->getArticles();
});

it('gets article by ID successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'article'], 200),
    ]);

    $client = new ArticleClient(baseUrl: '*', token: 'string');

    $response = $client->getArticleById(articleId: '1');

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

    $client = new ArticleClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->getArticleById(articleId: '1');
});

it('throws PolarApiNotFoundException on 404 status when getting article by ID', function (): void {
    Http::fake([
        '*' => Http::response([
            'type'   => 'ResourceNotFound',
            'detail' => 'string',
        ], 404),
    ]);

    $client = new ArticleClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiNotFoundException::class);
    $this->expectExceptionMessage('Resource Not Found');

    $client->getArticleById(articleId: '1');
});

it('gets article receivers count successfully', function (): void {
    Http::fake([
        '*' => Http::response([
            'free_subscribers'     => 10,
            'premium_subscribers'  => 5,
            'organization_members' => 3,
        ], 200),
    ]);

    $client = new ArticleClient(baseUrl: '*', token: 'string');

    $response = $client->getArticleReceiversCount(articleId: '1');

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

    $client = new ArticleClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiUnprocessableEntityException::class);
    $this->expectExceptionMessage('Unprocessable Entity');

    $client->getArticleReceiversCount(articleId: '1');
});

it('posts an article successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'article'], 201),
    ]);

    $client = new ArticleClient('*', 'string');

    $response = $client->postArticle(
        title: 'Test Title',
        body: 'Test Body',
        organizationId: 'org-id',
    );

    expect($response)->toBe(['data' => 'article']);
});

it('updates an article successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'updated article'], 200),
    ]);

    $client = new ArticleClient(baseUrl: '*', token: 'string');

    $response = $client->updateArticle(
        articleId: '1',
        title: 'Updated Title',
        body: 'Updated Body',
        visibility: 'private',
        paidSubscribersOnly: true,
        notifySubscribers: true,
        isPinned: true
    );

    expect($response)->toBe(['data' => 'updated article']);
});

it('deletes an article successfully', function (): void {
    Http::fake([
        '*' => Http::response(['data' => 'deleted article'], 200),
    ]);

    $client = new ArticleClient(baseUrl: '*', token: 'string');

    $response = $client->deleteArticle(articleId: '1');

    expect($response)->toBe(['data' => 'deleted article']);
});

it('throws PolarApiNotPermittedException on 403 status when deleting article', function (): void {
    Http::fake([
        '*' => Http::response([
            'type'   => 'NotPermitted',
            'detail' => 'string',
        ], 403),
    ]);

    $client = new ArticleClient(baseUrl: '*', token: 'string');

    $this->expectException(PolarApiNotPermittedException::class);
    $this->expectExceptionMessage('Not Permitted');

    $client->deleteArticle(articleId: '1');
});
