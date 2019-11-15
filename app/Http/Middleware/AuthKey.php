<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('APP-KEY');
        if ($token != 'ABC') {
            return response()->json(['message' => 'App key not found'], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
