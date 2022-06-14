<?php

namespace Pirsch\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TrackPageview
{
    public function handle(Request $request, Closure $next): mixed
    {
        return $next($request);
    }

    public function terminate(Request $request, mixed $response): void
    {
        if (! config('pirsch.token')) {
            return;
        }

        if (config('pirsch.honor_dnt') && $request->headers->get('DNT')) {
            return;
        }

        Http::withToken(config('pirsch.token'))
            ->post('https://api.pirsch.io/api/v1/hit', [
                'url' => $request->fullUrl(),
                'ip' => $request->ip(),
                'cf_connecting_ip' => $request->headers->get('CF-Connecting-IP'),
                'x_forwarded_for' => $request->headers->get('X-Forwarded-For'),
                'forwarded' => $request->headers->get('Forwarded'),
                'x_real_ip' => $request->headers->get('X-Real-IP'),
                'user_agent' => $request->userAgent(),
                'accept_language' => $request->headers->get('Accept-Language'),
                'referrer' => $request->headers->get('Referer'),
            ]);
    }
}
