# <img src="https://i.postimg.cc/wBmfXGXN/logomark-blue.png" alt="Polar Branding" width="25" height="25"> Laravel Polar API

[![Larastan Static Analysis](https://github.com/HDInnovations/laravel-polar-api/actions/workflows/larastan.yml/badge.svg)](https://github.com/HDInnovations/laravel-polar-api/actions/workflows/larastan.yml)
[![Laravel Pint](https://github.com/HDInnovations/laravel-polar-api/actions/workflows/pint.yml/badge.svg)](https://github.com/HDInnovations/laravel-polar-api/actions/workflows/pint.yml)
[![Pest Testing Suite](https://github.com/HDInnovations/laravel-polar-api/actions/workflows/pest.yml/badge.svg)](https://github.com/HDInnovations/laravel-polar-api/actions/workflows/pest.yml)
[![Pest Type Coverage](https://github.com/HDInnovations/laravel-polar-api/actions/workflows/type-coverage.yml/badge.svg)](https://github.com/HDInnovations/laravel-polar-api/actions/workflows/type-coverage.yml)
[![Packagist Version](https://img.shields.io/packagist/v/hdinnovations/laravel-polar-api)](https://packagist.org/packages/hdinnovations/laravel-polar-api)
[![Packagist Downloads](https://img.shields.io/packagist/dt/hdinnovations/laravel-polar-api)](https://packagist.org/packages/hdinnovations/laravel-polar-api)

**Laravel Polar API** is a Laravel package that provides an API wrapper for [polar.sh](Ihttps://polar.sh) API. This package simplifies the process of interacting with the Polar API by providing a set of convenient methods and classes.

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

## Usage Documentation

Please refer to our [documentation](https://hdinnovations.github.io/laravel-polar-api/) for detailed information on how to use this package and the endpoints + parameters it supports.

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

## Roadmap

- [ ] Support all GET requests
- [ ] Support all POST requests
- [ ] Support all PUT requests
- [ ] Support all DELETE requests
- [x] Add more exception handling
- [x] Add more examples
- [x] 100% test coverage
- [x] 100% type coverage
