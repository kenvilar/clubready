<?php

namespace App\Http\Middleware;

use Closure;

class PassportHeaderMiddleware
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
        $response = $next($request);

        $response->headers->set('Accept', 'application/json');
        $response->headers->set('Authorization', 'Bearer ' . request()->session()->get('myToken'));

        return $response;
    }
}
