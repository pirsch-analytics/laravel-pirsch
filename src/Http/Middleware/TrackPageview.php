<?php

namespace Pirsch\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Pirsch\Facades\Pirsch;

class TrackPageview
{
    /**
     * The URIs that should be excluded from tracking.
     *
     * @var array<int,string>
     */
    protected array $except = [
        'telescope',
        'horizon',
    ];

    /**
     * The Headers that should be excluded from tracking.
     *
     * @var array<int,string>
     */
    protected array $exceptHeaders = [
        'X-Livewire',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        if ($response instanceof RedirectResponse) {
            return $response;
        }

        if (! $this->inExceptArray($request) &&
            ! $this->inExceptHeadersArray($request)
        ) {
            Pirsch::track();
        }

        return $response;
    }

    /**
     * Determine if the request has a header that should not be tracked.
     */
    protected function inExceptHeadersArray(Request $request): bool
    {
        foreach ($this->exceptHeaders as $except) {
            if ($request->hasHeader($except)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if the request has a URI that should not be tracked.
     */
    protected function inExceptArray(Request $request): bool
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->fullUrlIs($except) || $request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
