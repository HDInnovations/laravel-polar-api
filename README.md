# Laravel Polar API

**Laravel Polar API** is a Laravel package that provides an API wrapper for the POLAR API. This package simplifies the process of interacting with the POLAR API by providing a set of convenient methods and classes.

## Note

This package is still under development and should not be used in production environments.

## Installation

To install the package, you can use Composer:

```sh
composer require hdinnovations/laravel-polar-api:dev-master
```

## Configuration

#### After installing the package, you need to publish the configuration file:

```sh
php artisan vendor:publish --provider="HDInnovations\LaravelPolarApi\Providers\PolarApiServiceProvider"
```

This command will publish a `polar-api.php` file in your `config` directory. You can use this file to configure the package. 
The configuration file contains the following options:

- `base_url`: The base URL of the POLAR API.
- `token`: The token (PAT) used to authenticate requests to the POLAR API.

#### You can also set the `POLAR_API_BASE_URL` and `POLAR_API_TOKEN` environment variables in your `.env` file which is recommended.

## Usage Example

https://docs.polar.sh/api/v1/articles/get

```php
use HDInnovations\LaravelPolarApi\Clients\ArticleClient;

$articleClient = new ArticleClient(config('polar-api.base_url'), config('polar-api.token'));

$articles = $articleClient->getArticles();
```

## Exceptions

The package throws the following exceptions:

- `HDInnovations\LaravelPolarApi\Exceptions\PolarApiNotFoundException`: Thrown when the requested resource is not found.
- `HDInnovations\LaravelPolarApi\Exceptions\PolarApiUnprocessableEntityException`: Thrown when the request is invalid.
- `HDInnovations\LaravelPolarApi\Exceptions\PolarApiValidationException`: Thrown when the request validation fails.

## Testing

To run the tests, use the following command:

```sh
composer test
```

## License

The package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Roadmap (In Order)

- [ ] Support all GET requests
- [ ] Support all POST requests
- [ ] Support all PUT requests
- [ ] Support all DELETE requests
- [ ] Add more exception handling
- [ ] Add more examples
- [ ] Add more tests
