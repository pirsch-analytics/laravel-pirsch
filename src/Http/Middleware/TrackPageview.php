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

        Http::withToken(config('pirsch.token'))
            ->post('https://api.pirsch.io/api/v1/hit', [
                'url' => $request->fullUrl(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'accept_language' => $request->headers->get('Accept-Language'),
                'referrer' => $request->headers->get('Referer'),
            ]);
    }
}
