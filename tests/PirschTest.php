<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Pirsch\Facades\Pirsch;

it('can track a request', function () {
    config(['pirsch.token' => 'test_token']);
    Http::fake([
        'https://api.pirsch.io/api/v1/hit' => Http::response(),
    ]);

    Pirsch::track();
    $this->get('/');

    Http::assertSent(function (Request $request): bool {
        expect($request->url())->toBe('https://api.pirsch.io/api/v1/hit');
        expect($request->hasHeader('Authorization', 'Bearer test_token'))->toBeTrue();
        expect($request->data())->toBe([
            'url' => 'http://localhost',
            'ip' => '127.0.0.1',
            'user_agent' => 'Symfony',
            'accept_language' => 'en-us,en;q=0.5',
            'sec_ch_ua' => null,
            'sec_ch_ua_mobile' => null,
            'sec_ch_ua_platform' => null,
            'sec_ch_ua_platform_version' => null,
            'sec_ch_width' => null,
            'sec_ch_viewport_width' => null,
            'referrer' => null,
        ]);

        return true;
    });
});

it('can send an event', function () {
    config(['pirsch.token' => 'test_token']);
    Http::fake([
        'https://api.pirsch.io/api/v1/event' => Http::response(),
    ]);

    Pirsch::track('name', ['meta' => 'data']);
    $this->get('/');

    Http::assertSent(function (Request $request) {
        expect($request->url())->toBe('https://api.pirsch.io/api/v1/event');
        expect($request->hasHeader('Authorization', 'Bearer test_token'))->toBeTrue();
        expect($request->data())->toBe([
            'url' => 'http://localhost',
            'ip' => '127.0.0.1',
            'user_agent' => 'Symfony',
            'accept_language' => 'en-us,en;q=0.5',
            'sec_ch_ua' => null,
            'sec_ch_ua_mobile' => null,
            'sec_ch_ua_platform' => null,
            'sec_ch_ua_platform_version' => null,
            'sec_ch_width' => null,
            'sec_ch_viewport_width' => null,
            'referrer' => null,
            'event_name' => 'name',
            'event_meta' => [
                'meta' => 'data',
            ],
        ]);

        return true;
    });
});
