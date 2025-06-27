<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken() ?? $request->input('token');

        if ($token !== config('app.api_static_token')) {
            return response()->json([
                'message' => 'Invalid API Token',
            ], 401);
        }

        return $next($request);
    }
}
