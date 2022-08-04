[![Packagist Version](https://img.shields.io/packagist/v/pirsch-analytics/laravel-pirsch)](https://packagist.org/packages/pirsch-analytics/laravel-pirsch)
[![Packagist Downloads](https://img.shields.io/packagist/dt/pirsch-analytics/laravel-pirsch)](https://packagist.org/packages/pirsch-analytics/laravel-pirsch/stats)

# Laravel Pirsch

This package is the official Laravel integration for [Pirsch Analytics](https://pirsch.io).

## Installation

1. Install this package:
   ```bash
   composer require pirsch-analytics/laravel-pirsch
   ```
2. Set the `PIRSCH_TOKEN` environment variable to your Pirsch access token. Leave it empty in non-production environments to disable tracking.

## Usage

### Track pageviews

#### Automatically

This package comes with a `TrackPageview` middleware that allows you to track pageviews automatically.
Apply the middleware to your web routes by adding it to the `web` key of the `$middlewareGroups` property in your `app/Http/Kernel.php` class:

```php
protected $middlewareGroups = [
    'web' => [
        // ...
        \Pirsch\Http\Middleware\TrackPageview::class,
    ],

    // ...
];
```

#### Manually

If you want to manually track pageviews instead, you can use the `Pirsch::track()` method.
Calling this method without any arguments will track a pageview for the current HTTP request:

```php
use Pirsch\Facades\Pirsch;

Pirsch::track();
```

### Track events

Pirsch allows you to [track custom events](https://docs.pirsch.io/dashboard/events) in order to measure additional information.
You can use the `Pirsch::track()` method with a name and optional metadata to track an event:

```php
use Pirsch\Facades\Pirsch;

Pirsch::track(
    name: 'Button clicked',
    meta: [
        'Label' => 'Get started',
    ],
);
```
