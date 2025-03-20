[![Packagist Version](https://img.shields.io/packagist/v/pirsch-analytics/laravel-pirsch)](https://packagist.org/packages/pirsch-analytics/laravel-pirsch)
[![Packagist Downloads](https://img.shields.io/packagist/dt/pirsch-analytics/laravel-pirsch)](https://packagist.org/packages/pirsch-analytics/laravel-pirsch/stats)

# Pirsch for Laravel

This package is the official Laravel integration for [Pirsch Analytics](https://pirsch.io).

## Installation

1. Install this package:
   ```bash
   composer require pirsch-analytics/laravel-pirsch
   ```
2. Add the Pirsch access token to your `.env` file. Leave it empty in non-production environments to disable tracking:

   1. Visit the [Pirsch "Integration" settings page](https://dashboard.pirsch.io/settings/integration).
   2. Make sure the correct domain is selected in the top left corner of the page.
   3. Scroll down to the "Clients" section and press the "Add Client" button.
   4. Select "Access Key (write-only)" as type and enter a description.
   5. Press the "Create Client" button and copy the generated "Client secret".
   6. Add the copied token to your `.env` file:

      ```bash
      # ...

      PIRSCH_TOKEN=pa_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
      ```

## Usage

### Track pageviews

#### Automatically

This package comes with a `TrackPageview` middleware that allows you to track pageviews automatically.
Apply the middleware to your web routes by appending it in the `withMiddleware` method in your `bootstrap/app.php` file:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->web(append: [
        \Pirsch\Http\Middleware\TrackPageview::class,
    ]);
})
```

You can also apply the middleware to specific routes or groups:

```php
use Pirsch\Http\Middleware\TrackPageview;

Route::middleware(TrackPageview::class)->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});
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

### Filter pages

You can configure the `TrackPageview` middleware to exclude specific pages from being tracked.

On a specific rouute, you can exclude pages by adding a `except` property to the middleware class:

```php
use Pirsch\Http\Middleware\TrackPageview;

Route::middleware(TrackPageview::class.':url/to/exclude/*')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});
```

Multiple urls can be excluded by separating them with a comma:

```php
use Pirsch\Http\Middleware\TrackPageview;

Route::middleware(TrackPageview::class.':url/to/exclude/*,url/to/exclude2/*')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});
```

To exclude pages globally, you can create a new middleware that extends the `TrackPageview` middleware and add an `except` property:

```php
namespace App\Http\Middleware;

use Pirsch\Http\Middleware\TrackPageview as Middleware;

class TrackPageview extends Middleware
{
    /**
     * The URIs that should be excluded from tracking.
     *
     * @var array<int,string>
     */
    protected array $except = [
        'url/to/exclude/*',
    ];

    /**
     * The Headers that should be excluded from tracking.
     *
     * @var array<int,string>
     */
    protected array $exceptHeaders = [
        'X-ExcludedHeader',
    ];
}
```

- `except` is an array with all URIs paths taht you want to exclude from tracking.
- `exceptHeaders` is an array with all Headers that you want to exclude from tracking.

Then replace the `TrackPageview` middleware with this one on your `bootstrap/app.php` middleware configuration:

```diff
  ->withMiddleware(function (Middleware $middleware) {
      $middleware->web(append: [
-         \Pirsch\Http\Middleware\TrackPageview::class,
+         \App\Http\Middleware\TrackPageview::class,
      ]);
  })
```
