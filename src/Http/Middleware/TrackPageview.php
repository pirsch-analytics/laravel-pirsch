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
        return $next($request);
    }

    public function terminate(Request $request, mixed $response): void
    {
        if ($response instanceof RedirectResponse) {
            return;
        }

        Pirsch::track();
    }
}
