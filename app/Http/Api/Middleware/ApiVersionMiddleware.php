<?php

namespace App\Http\Api\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiVersionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $acceptHeader = $request->header('Accept');
        $appName = config('app.name');

        if (preg_match("/application\/vnd\.$appName\.v(\d+)\+json/", $acceptHeader, $matches)) {
            $version = $matches[1];
        } else {
            $version = 1;
        }

        $request->attributes->set('api_version', $version);

        return $next($request);
    }
}
