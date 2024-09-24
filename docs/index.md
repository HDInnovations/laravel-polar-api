# Laravel Polar API Documentation

## Table of Contents
- [ArticleClient](#articleclient)
    - [getArticles](#getarticles)
    - [getArticleById](#getarticlebyid)
    - [getArticleReceiversCount](#getarticlereceiverscount)
    - [postArticle](#postarticle)
    - [updateArticle](#updatearticle)
    - [deleteArticle](#deletearticle)
- [CheckoutClient](#checkoutclient)
    - [createCheckout](#createcheckout)
    - [getCheckoutById](#getcheckoutbyid)
- [ProductClient](#productclient)
    - [getProducts](#getproducts)
    - [getProductById](#getproductbyid)
- [SubscriptionClient](#subscriptionclient)
    - [getSubscriptions](#getsubscriptions)
- [OrganizationClient](#organizationclient)
    - [getOrganizations](#getorganizations)
    - [getOrganizationById](#getorganizationbyid)
- [Exceptions](#exceptions)
- [Testing](#testing)
- [Test Coverage](#test-coverage)
- [Static Analysis](#static-analysis)
- [Type Coverage](#type-coverage)
- [License](#license)

## ArticleClient

### getArticles

Fetches a list of articles.

**Endpoint:** `/articles`

**Method:** `GET`

**Parameters:**

| Name            | Type    | Description                    | Required |
|-----------------|---------|--------------------------------|----------|
| organizationId  | string  | The ID of the organization     | No       |
| visibility      | string  | The visibility of the article  | No       |
| isSubscribed    | bool    | Is the user subscribed         | No       |
| isPublished     | bool    | Is the article published       | No       |
| isPinned        | bool    | Is the article pinned          | No       |
| page            | int     | The page number for pagination | No       |
| limit           | int     | The number of items per page   | No       |

**Example:**

```php
// Import the ArticleClient
use HDInnovations\LaravelPolarApi\Clients\ArticleClient;

// Initialize the client
$articleClient = new ArticleClient(baseUrl: config('polar-api.base_url'), token: config('polar-api.token'));

// Get articles
$articles = $articleClient->getArticles();
```

### getArticleById

Fetches an article by its ID.

**Endpoint:** `/articles/{articleId}`

**Method:** `GET`

**Parameters:**

| Name      | Type   | Description          | Required |
|-----------|--------|----------------------|----------|
| articleId | string | The ID of the article | Yes      |

**Example:**

```php
// Import the ArticleClient
use HDInnovations\LaravelPolarApi\Clients\ArticleClient;

// Initialize the client
$articleClient = new ArticleClient(baseUrl: config('polar-api.base_url'), token: config('polar-api.token'));

// Get article by ID
$article = $articleClient->getArticleById(articleId: 'article-id');
```

### getArticleReceiversCount

Fetches the number of potential receivers for an article.

**Endpoint:** `/articles/{articleId}/receivers`

**Method:** `GET`

**Parameters:**

| Name      | Type   | Description          | Required |
|-----------|--------|----------------------|----------|
| articleId | string | The ID of the article | Yes      |

**Example:**

```php
// Import the ArticleClient
use HDInnovations\LaravelPolarApi\Clients\ArticleClient;

// Initialize the client
$articleClient = new ArticleClient(baseUrl: config('polar-api.base_url'), token: config('polar-api.token'));

// Get article receivers count
$receiversCount = $articleClient->getArticleReceiversCount(articleId: 'article-id');
```

### postArticle

Posts a new article.

**Endpoint:** `/articles`

**Method:** `POST`

**Parameters:**

| Name                | Type   | Description                    | Required |
|---------------------|--------|--------------------------------|----------|
| title               | string | The title of the article       | Yes      |
| body                | string | The body of the article        | Yes      |
| organizationId      | string | The ID of the organization     | Yes      |
| visibility          | string | The visibility of the article  | No       |
| paidSubscribersOnly | bool   | Paid subscribers only          | No       |
| notifySubscribers   | bool   | Notify subscribers             | No       |
| isPinned            | bool   | Is the article pinned          | No       |

**Example:**

```php
// Import the ArticleClient
use HDInnovations\LaravelPolarApi\Clients\ArticleClient;

// Initialize the client
$articleClient = new ArticleClient(baseUrl: config('polar-api.base_url'), token: config('polar-api.token'));

// Post article
$article = $articleClient->postArticle(title: 'Article Title', body: 'Article Body', organizationId: 'organization-id');
```

### updateArticle

Updates an existing article.

**Endpoint:** `/articles/{articleId}`

**Method:** `PATCH`

**Parameters:**

| Name                | Type   | Description                    | Required |
|---------------------|--------|--------------------------------|----------|
| articleId           | string | The ID of the article          | Yes      |
| title               | string | The title of the article       | No       |
| body                | string | The body of the article        | No       |
| visibility          | string | The visibility of the article  | No       |
| paidSubscribersOnly | bool   | Paid subscribers only          | No       |
| notifySubscribers   | bool   | Notify subscribers             | No       |
| isPinned            | bool   | Is the article pinned          | No       |

**Example:**

```php
// Import the ArticleClient
use HDInnovations\LaravelPolarApi\Clients\ArticleClient;

// Initialize the client
$articleClient = new ArticleClient(baseUrl: config('polar-api.base_url'), token: config('polar-api.token'));

// Update article
$article = $articleClient->updateArticle(articleId: 'article-id', title: 'Article Title', body: 'Article Body');
```

### deleteArticle

Deletes an article.

**Endpoint:** `/articles/{articleId}`

**Method:** `DELETE`

**Parameters:**

| Name      | Type   | Description          | Required |
|-----------|--------|----------------------|----------|
| articleId | string | The ID of the article | Yes      |

**Example:**

```php
// Import the ArticleClient
use HDInnovations\LaravelPolarApi\Clients\ArticleClient;

// Initialize the client
$articleClient = new ArticleClient(baseUrl: config('polar-api.base_url'), token: config('polar-api.token'));

// Delete article
$articleClient->deleteArticle(articleId: 'article-id');
```

## CheckoutClient

### createCheckout

Creates a new checkout session.

**Endpoint:** `/checkouts/`

**Method:** `POST`

**Parameters:**

| Name            | Type   | Description                    | Required |
|-----------------|--------|--------------------------------|----------|
| product_price_id | string | The ID of the product price    | Yes      |
| success_url     | string | The URL to redirect on success | Yes      |
| customer_email  | string | The email of the customer      | Yes      |

### getCheckoutById

Fetches a checkout session by its ID.

**Endpoint:** `/checkouts/{checkoutId}`

**Method:** `GET`

**Parameters:**

| Name        | Type   | Description                | Required |
|-------------|--------|----------------------------|----------|
| checkoutId  | string | The ID of the checkout     | Yes      |

## ProductClient

### getProducts

Fetches a list of products.

**Endpoint:** `/products`

**Method:** `GET`

**Parameters:**

| Name           | Type    | Description                    | Required |
|----------------|---------|--------------------------------|----------|
| organizationId | string  | The ID of the organization     | Yes      |
| isArchived     | bool    | Is the product archived        | No       |
| isRecurring    | bool    | Is the product recurring       | No       |
| benefitId      | string  | The ID of the benefit          | No       |
| type           | string  | The type of the product        | No       |
| page           | int     | The page number for pagination | No       |
| limit          | int     | The number of items per page   | No       |

### getProductById

Fetches a product by its ID.

**Endpoint:** `/products/{productId}`

**Method:** `GET`

**Parameters:**

| Name      | Type   | Description          | Required |
|-----------|--------|----------------------|----------|
| productId | string | The ID of the product | Yes      |

## SubscriptionClient

### getSubscriptions

Fetches a list of subscriptions.

**Endpoint:** `/subscriptions`

**Method:** `GET`

**Parameters:**

| Name           | Type    | Description                    | Required |
|----------------|---------|--------------------------------|----------|
| organizationId | string  | The ID of the organization     | No       |
| productId      | string  | The ID of the product          | No       |
| type           | string  | The type of the subscription   | No       |
| active         | bool    | Is the subscription active     | No       |
| page           | int     | The page number for pagination | No       |
| limit          | int     | The number of items per page   | No       |

## OrganizationClient

### getOrganizations

Fetches a list of organizations.

**Endpoint:** `/organizations`

**Method:** `GET`

**Parameters:**

| Name      | Type    | Description                    | Required |
|-----------|---------|--------------------------------|----------|
| slug      | string  | The slug of the organization   | No       |
| isMember  | bool    | Is the user a member           | No       |
| page      | int     | The page number for pagination | No       |
| limit     | int     | The number of items per page   | No       |
| sorting   | string  | The sorting criteria           | No       |

### getOrganizationById

Fetches an organization by its ID.

**Endpoint:** `/organizations/{organizationId}`

**Method:** `GET`

**Parameters:**

| Name           | Type   | Description                    | Required |
|----------------|--------|--------------------------------|----------|
| organizationId | string | The ID of the organization     | Yes      |


## Exceptions

The package throws the following exceptions:

- `HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException`: Thrown when the requested resource is not found.
- `HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException`: Thrown when the request is invalid.
- `HDInnovations\LaravelPolarApi\Exceptions\PolarApiValidationException`: Thrown when the request validation fails.
- `HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnauthorizedException`: Thrown when the request is unauthorized.

## Testing

To run the tests, use the following command:

```sh
composer test
```

## Test Coverage

To generate the test coverage, use the following command:

```sh
composer test-coverage
```

## Static Analysis

To run static analysis, use the following command:

```sh
composer analyze
```

## Type Coverage

To check the type coverage, use the following command:

```sh
composer test-type-coverage
```

## License

The package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).