<?php

declare(strict_types=1);

namespace HDInnovations\LaravelPolarApi\Clients;

use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotPermittedException;
use HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException;
use JsonException;

class CheckoutClient extends BaseClient
{
    /**
     * Create a new checkout.
     *
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     * @throws PolarApiNotPermittedException
     * @throws JsonException
     */
    final public function createCheckout(
        string $productPriceId,
        string $successUrl,
        string $customerEmail
    ): array {
        $data = [
            'product_price_id' => $productPriceId,
            'success_url'      => $successUrl,
            'customer_email'   => $customerEmail,
        ];

        return $this->request(method: 'post', endpoint: '/checkouts/', params: $data);
    }

    /**
     * Get a checkout session by its ID.
     *
     * @throws PolarApiUnprocessableEntityException
     * @throws PolarApiNotFoundException
     * @throws PolarApiNotPermittedException
     * @throws JsonException
     */
    final public function getCheckoutById(string $checkoutId): array
    {
        return $this->request(method: 'get', endpoint: "/checkouts/{$checkoutId}");
    }
}
