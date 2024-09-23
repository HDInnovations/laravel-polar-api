<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Clients;

use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotPermittedException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use JsonException;

class ArticleClient extends BaseClient
{
    /**
     * Get articles from the Polar API.
     *
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     * @throws PolarApiNotPermittedException
     * @throws JsonException
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

        return $this->request(method: 'get', endpoint: '/articles', params: $params);
    }

    /**
     * Get an article by its ID from the Polar API.
     *
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     * @throws PolarApiNotPermittedException
     * @throws JsonException
     */
    final public function getArticleById(string $articleId): array
    {
        return $this->request(method: 'get', endpoint: "/articles/{$articleId}");
    }

    /**
     * Get the number of potential receivers for an article.
     *
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     * @throws PolarApiNotPermittedException
     * @throws JsonException
     */
    final public function getArticleReceiversCount(string $articleId): array
    {
        $response = $this->request(method: 'get', endpoint: "/articles/{$articleId}/receivers");

        return [
            'free_subscribers'     => $response['free_subscribers'] ?? 0,
            'premium_subscribers'  => $response['premium_subscribers'] ?? 0,
            'organization_members' => $response['organization_members'] ?? 0,
        ];
    }

    /**
     * Post an article to the Polar API.
     *
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     * @throws PolarApiNotPermittedException
     * @throws JsonException
     */
    final public function postArticle(
        string $title,
        string $body,
        string $organizationId,
        string $visibility = 'public',
        bool $paidSubscribersOnly = false,
        bool $notifySubscribers = false,
        bool $isPinned = false
    ): array {
        $data = [
            'title'                 => $title,
            'body'                  => $body,
            'organization_id'       => $organizationId,
            'visibility'            => $visibility,
            'paid_subscribers_only' => $paidSubscribersOnly,
            'notify_subscribers'    => $notifySubscribers,
            'is_pinned'             => $isPinned,
        ];

        return $this->request(method: 'post', endpoint: '/articles', params: $data);
    }

    /**
     * Update an article in the Polar API.
     *
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     * @throws PolarApiNotPermittedException
     * @throws JsonException
     */
    final public function updateArticle(
        string $articleId,
        ?string $title,
        ?string $body,
        ?string $visibility,
        ?bool $paidSubscribersOnly,
        ?bool $notifySubscribers,
        ?bool $isPinned
    ): array {
        $data = [
            'title'                 => $title,
            'body'                  => $body,
            'visibility'            => $visibility,
            'paid_subscribers_only' => $paidSubscribersOnly,
            'notify_subscribers'    => $notifySubscribers,
            'is_pinned'             => $isPinned,
        ];

        return $this->request(method: 'patch', endpoint: "/articles/{$articleId}", params: $data);
    }

    /**
     * Delete an article in the Polar API.
     *
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     * @throws PolarApiNotPermittedException
     * @throws JsonException
     */
    final public function deleteArticle(string $articleId): array
    {
        return $this->request(method: 'delete', endpoint: "/articles/{$articleId}");
    }
}
