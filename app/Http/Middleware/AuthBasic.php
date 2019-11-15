<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthBasic
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::onceBasic()) {
            return response()->json(['message' => 'Auth failed'], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
