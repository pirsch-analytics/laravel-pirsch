<?php

namespace Pirsch;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class Pirsch
{
    public static function track(
        ?string $name = null,
        ?array $meta = null,
    ): void {
        app()->terminating(function () use ($name, $meta) {
            if (! config('pirsch.token')) {
                return;
            }

            try {
                Http::withToken(config('pirsch.token'))
                    ->timeout(config('pirsch.timeout'))
                    ->post(
                        url: 'https://api.pirsch.io/api/v1/'.($name === null ? 'hit' : 'event'),
                        data: [
                            'url' => request()->fullUrl(),
                            'ip' => request()->ip(),
                            'user_agent' => request()->userAgent(),
                            'accept_language' => request()->header('Accept-Language'),
                            'referrer' => request()->header('Referer'),
                            ...$name === null
                                ? []
                                : [
                                    'event_name' => $name,
                                    'event_meta' => $meta,
                                ],
                        ],
                    );
            } catch (ConnectionException) {
            }
        });
    }
}
