<?php

namespace Pirsch\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Pirsch\Facades\Pirsch;

class TrackPageview
{
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        if ($response instanceof RedirectResponse) {
            return $response;
        }

        if ($request->hasHeader('X-Livewire')) {
            return $response;
        }

        if (str_starts_with($request->route()->uri, 'telescope/')) {
            return $response;
        }

        if (str_starts_with($request->route()->uri, 'horizon/')) {
            return $response;
        }

        Pirsch::track();

        return $response;
    }
}
