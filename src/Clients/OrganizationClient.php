<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Clients;

use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiValidationException;
use JsonException;

class OrganizationClient extends BaseClient
{
    /**
     * Get organizations from the Polar API.
     *
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     * @throws JsonException
     * @throws PolarApiValidationException
     * @throws \HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotPermittedException
     */
    final public function getOrganizations(
        ?string $slug = null,
        ?bool $isMember = null,
        int $page = 1,
        int $limit = 10,
        ?string $sorting = 'created_at'
    ): array {
        if ($slug === null && $isMember === null) {
            throw new PolarApiValidationException('Either slug or isMember must be provided.');
        }

        $params = array_filter([
            'slug'      => $slug,
            'is_member' => $isMember,
            'page'      => $page,
            'limit'     => $limit,
            'sorting'   => $sorting,
        ]);

        return $this->request('get', '/organizations', $params);
    }

    /**
     * Get an organization by its ID from the Polar API.
     *
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     * @throws JsonException
     * @throws \HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotPermittedException
     */
    final public function getOrganizationById(string $organizationId): array
    {
        return $this->request('get', "/organizations/{$organizationId}");
    }
}
