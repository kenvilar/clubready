<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Response;

class SuperAdminMiddleware
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
        $super_admin = User::query()->find(request()->user()->id)->super_admin;

        if (config('app.debug')) {
            $error = new Response(view('auth.unauthorized')->with('role', 'SUPER ADMIN'));
        } else {
            $error = redirect('/');
        }

        if (!$request->acceptsHtml() || !collect($request->route()->middleware())->contains('web')) {
            $error = response()
                ->json([
                    'error' => 'This action is unauthorized. This is for only SUPER ADMIN.',
                    'code' => 403
                ], 403);
        }

        if ($request->user() && $super_admin != null) {
            if ($request->user()->id != $super_admin->user_id) {
                return $error;
            }
        } else if ($request->user() && $super_admin == null) {
            return $error;
        }

        return $next($request);
    }
}
