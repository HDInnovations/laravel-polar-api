<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Clients;

class ArticleClient extends BaseClient
{
    /**
     * Get articles from the Polar API.
     *
     * @throws \HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException
     * @throws \HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException
     */
    final public function getArticles(
        ?string $organizationId = null,
        ?string $visibility = null,
        ?bool $isSubscribed = null,
        ?bool $isPublished = null,
        ?bool $isPinned = null,
        int $page = 1,
        int $limit = 10
    ): array {
        $params = array_filter([
            'organization_id' => $organizationId,
            'visibility'      => $visibility,
            'is_subscribed'   => $isSubscribed,
            'is_published'    => $isPublished,
            'is_pinned'       => $isPinned,
            'page'            => $page,
            'limit'           => $limit,
        ]);

        return $this->request('get', '/articles', $params);
    }

    /**
     * Get an article by its ID from the Polar API.
     *
     * @throws \HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException
     * @throws \HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException
     */
    final public function getArticleById(string $articleId): array
    {
        return $this->request('get', "/articles/{$articleId}");
    }

    /**
     * Get the number of potential receivers for an article.
     *
     * @throws \HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException
     * @throws \HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException
     */
    final public function getArticleReceiversCount(string $articleId): array
    {
        $response = $this->request('get', "/articles/{$articleId}/receivers");

        return [
            'free_subscribers'     => $response['free_subscribers'] ?? 0,
            'premium_subscribers'  => $response['premium_subscribers'] ?? 0,
            'organization_members' => $response['organization_members'] ?? 0,
        ];
    }
}
