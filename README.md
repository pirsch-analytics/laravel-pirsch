[![Packagist Version](https://img.shields.io/packagist/v/pirsch-analytics/laravel-pirsch)](https://packagist.org/packages/pirsch-analytics/laravel-pirsch)
[![Packagist Downloads](https://img.shields.io/packagist/dt/pirsch-analytics/laravel-pirsch)](https://packagist.org/packages/pirsch-analytics/laravel-pirsch/stats)

# Laravel Pirsch

This package is the official Laravel integration for [Pirsch Analytics](https://pirsch.io).

## Installation

1. Install this package.
    ```bash
    composer require pirsch-analytics/laravel-pirsch
    ```
2. Set the `PIRSCH_TOKEN` environment variable to your Pirsch access token. Leave it empty in non-production environments to disable tracking.
3. Optionally publish the configuration file.
    ```bash
    php artisan vendor:publish --tag="pirsch-config"
    ```

## Usage

### Track pageviews

To automatically track pageviews for routes, assign them the `TrackPageview` middleware.

```php
Route::middleware(Pirsch\Http\Middleware\TrackPageview::class)
```
