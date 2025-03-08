<?php

namespace App\Http\Middleware;

use App\Helpers\XMLHelper;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FormatResponseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $format = $request->header('Accept') === 'application/xml' ? 'xml' : 'json';

        if ($format === 'xml' && $response instanceof JsonResponse) {
            return response($this->toXml($response->getData(true)), $response->status())
                ->header('Content-Type', 'application/xml');
        }

        return $response;
    }

    private function toXml(array $data): string
    {
        return XMLHelper::convertArrayToXml(['response' => $data]);
    }
}
