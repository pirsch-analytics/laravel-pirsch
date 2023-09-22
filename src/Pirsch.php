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
                    ->timeout(5)
                    ->retry(
                        times: 3,
                        sleepMilliseconds: 100,
                        throw: false,
                    )
                    ->post(
                        url: 'https://api.pirsch.io/api/v1/'.($name === null ? 'hit' : 'event'),
                        data: [
                            'url' => request()->fullUrl(),
                            'ip' => request()->ip(),
                            'user_agent' => request()->userAgent(),
                            'accept_language' => request()->header('Accept-Language'),
                            'sec_ch_ua' => request()->header('Sec-CH-UA'),
                            'sec_ch_ua_mobile' => request()->header('Sec-CH-UA-Mobile'),
                            'sec_ch_ua_platform' => request()->header('Sec-CH-UA-Platform'),
                            'sec_ch_ua_platform_version' => request()->header('Sec-CH-UA-Platform-Version'),
                            'sec_ch_width' => request()->header('Sec-CH-Width'),
                            'sec_ch_viewport_width' => request()->header('Sec-CH-Viewport-Width'),
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
