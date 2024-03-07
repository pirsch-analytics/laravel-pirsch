<?php

use Illuminate\Support\Facades\Route;
use Pirsch\Facades\Pirsch;
use Pirsch\Http\Middleware\TrackPageview;

it('handles request', function () {
    Pirsch::shouldReceive('track')
        ->once();

    Route::middleware(TrackPageview::class)
        ->get('/', fn () => 'Hello World');

    $this->get('/');

    expect(true)->toBeTrue();
});

it('skips redirects', function () {
    Pirsch::spy();

    Route::middleware(TrackPageview::class)
        ->get('/', fn () => redirect('/home'));

    $this->get('/');

    Pirsch::shouldNotHaveBeenCalled();
    expect(true)->toBeTrue();
});

it('skips Livewire', function () {
    Pirsch::spy();

    Route::middleware(TrackPageview::class)
        ->get('/', fn () => 'Hello World');

    $this->get('/', ['X-Livewire' => 'true']);

    Pirsch::shouldNotHaveBeenCalled();
    expect(true)->toBeTrue();
});

it('skips telescope', function () {
    Pirsch::spy();

    Route::middleware(TrackPageview::class)
        ->get('telescope/test', fn () => 'Hello World');

    $this->get('/telescope/test');

    Pirsch::shouldNotHaveBeenCalled();
    expect(true)->toBeTrue();
});
