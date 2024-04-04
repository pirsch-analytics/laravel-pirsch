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
});

it('skips redirects', function () {
    Pirsch::spy();

    Route::middleware(TrackPageview::class)
        ->get('/', fn () => redirect('/home'));

    $this->get('/');

    Pirsch::shouldNotHaveReceived('track');
});

it('skips Livewire', function () {
    Pirsch::spy();

    Route::middleware(TrackPageview::class)
        ->get('/', fn () => 'Hello World');

    $this->get('/', ['X-Livewire' => 'true']);

    Pirsch::shouldNotHaveReceived('track');
});

it('skips Telescope', function () {
    Pirsch::spy();

    Route::middleware(TrackPageview::class)
        ->get('/telescope/test', fn () => 'Hello World');

    $this->get('/telescope/test');

    Pirsch::shouldNotHaveReceived('track');
});

it('skips Horizon', function () {
    Pirsch::spy();

    Route::middleware(TrackPageview::class)
        ->get('horizon/test', fn () => 'Hello World');

    $this->get('/horizon/test');

    Pirsch::shouldNotHaveReceived('track');
});

it('skips parameter except', function () {
    Pirsch::spy();

    Route::middleware(TrackPageview::class.':myurl/*')
        ->get('myurl/test', fn () => 'Hello World');

    $this->get('/myurl/test');

    Pirsch::shouldNotHaveReceived('track');
});
