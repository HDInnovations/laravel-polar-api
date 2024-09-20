<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Clients;

use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiValidationException;

class ProductClient extends BaseClient
{
    /**
     * Get products from the Polar API.
     *
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     * @throws PolarApiValidationException
     */
    final public function getProducts(
        ?string $organizationId = null,
        ?bool $isArchived = null,
        ?bool $isRecurring = null,
        ?string $benefitId = null,
        ?string $type = null,
        int $page = 1,
        int $limit = 10
    ): array {
        if ($organizationId === null) {
            throw new PolarApiValidationException('The organization_id parameter is required.');
        }

        $params = array_filter([
            'organization_id' => $organizationId,
            'is_archived'     => $isArchived,
            'is_recurring'    => $isRecurring,
            'benefit_id'      => $benefitId,
            'type'            => $type,
            'page'            => $page,
            'limit'           => $limit,
        ]);

        return $this->request('get', '/products', $params);
    }

    /**
     * Get a product by its ID from the Polar API.
     *
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     */
    final public function getProductById(string $productId): array
    {
        return $this->request('get', "/products/{$productId}");
    }
}
