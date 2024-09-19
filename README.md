# Laravel Polar API

**Laravel Polar API** is a Laravel package that provides an API wrapper for the POLAR API. This package simplifies the process of interacting with the POLAR API by providing a set of convenient methods and classes.

## Installation

To install the package, you can use Composer:

```sh
composer require hdinnovations/laravel-polar-api
```

## Configuration

#### After installing the package, you need to publish the configuration file:

```sh
php artisan vendor:publish --provider="HDInnovations\LaravelPolarApi\Providers\PolarApiServiceProvider"
```

This command will publish a `polar-api.php` file in your `config` directory. You can use this file to configure the package.

#### You then need to add the service provider to the providers array in your config/app.php file:
    
```php
'providers' => [
    // Other service providers...
    HDInnovations\LaravelPolarApi\Providers\PolarApiServiceProvider::class,
],
```

#### You should also add the facade to the aliases array in your config/app.php file:

```php
'aliases' => [
    // Other facades...
    'PolarApi' => HDInnovations\LaravelPolarApi\Facades\PolarApiFacade::class,
],
```

## Usage


## Exceptions


## Testing

To run the tests, use the following command:

```sh
composer test
```

## License

The package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
