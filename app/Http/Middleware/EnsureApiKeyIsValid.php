<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiKeyIsValid
{
    public function handle(Request $request, Closure $next): Response
    {
        $configuredApiKey = config('services.api.key');
        $requestApiKey = $request->header('X-API-KEY');

        if (! is_string($configuredApiKey) || $configuredApiKey === '') {
            return response()->json([
                'message' => 'API key is not configured.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if (! is_string($requestApiKey) || ! hash_equals($configuredApiKey, $requestApiKey)) {
            return response()->json([
                'message' => 'Invalid API key.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
