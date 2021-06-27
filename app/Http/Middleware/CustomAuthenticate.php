<?php


namespace App\Http\Middleware;


use App\Providers\RouteServiceProvider;

class CustomAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        $user = 'user';
        if ($user->isAuthenticated($request->bearerToken())) {
            return $next($request);
        }
    }
}
