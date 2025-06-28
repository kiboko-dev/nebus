<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('static-api-key');
        $validKey = config('app.static_api_key');
        if ($apiKey !== $validKey) {
            return response()->json(['error' => 'Invalid API key'], 401);
        }

        return $next($request);
    }
}
