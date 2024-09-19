<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Clients;

class SubscriptionClient extends BaseClient
{
    /**
     * Get subscriptions from the Polar API.
     *
     * @throws \HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException
     * @throws \HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException
     */
    final public function getSubscriptions(
        ?string $organizationId = null,
        ?string $productId = null,
        ?string $type = null,
        ?bool $active = null,
        int $page = 1,
        int $limit = 10
    ): array {
        $params = array_filter([
            'organization_id' => $organizationId,
            'product_id'      => $productId,
            'type'            => $type,
            'active'          => $active,
            'page'            => $page,
            'limit'           => $limit,
        ]);

        return $this->request('get', '/subscriptions', $params);
    }
}
