<?php

declare(strict_types=1);

use HDInnovations\LaravelPolarApi\Clients\ArticleClient;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotPermittedException;
use Illuminate\Support\Facades\Http;

it('throws PolarApiNotPermittedException on 403 status', function (): void {
    Http::fake([
        '*' => Http::response([
            'type'   => 'NotPermitted',
            'detail' => 'string',
        ], 403),
    ]);

    $client = new ArticleClient('https://api.example.com', 'your-token');

    try {
        $client->deleteArticle('1');
    } catch (PolarApiNotPermittedException $e) {
        expect($e->getMessage())->toBe('Not Permitted')
            ->and($e->getType())->toBe('NotPermitted')
            ->and($e->getDetail())->toBe('string');
    }
});
