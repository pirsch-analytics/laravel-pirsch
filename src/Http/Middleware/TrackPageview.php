<?php

namespace Pirsch\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Pirsch\Facades\Pirsch;

class TrackPageview
{
    public function handle(Request $request, Closure $next): mixed
    {
        Pirsch::track();

        return $next($request);
    }
}
