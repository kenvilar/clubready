<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Response;

class StrictUserPermissionMiddleware
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
        $club_member = User::query()->find($request->user()->id)->club_member;

        if (config('app.debug')) {
            $error = new Response(view('auth.unauthorized'));
        } else {
            $error = redirect('/');
        }

        if (!$request->acceptsHtml() || !collect($request->route()->middleware())->contains('web')) {
            $error = response()
                ->json([
                    'error' => 'This action is unauthorized.',
                    'code' => 403
                ], 403);
        }

        if ($request->user() && $club_member != null) {
            if ($request->user()->id != $club_member->user_id) {
                return $error;
            }
        } else if ($request->user() && $club_member == null) {
            return $error;
        }

        return $next($request);
    }
}
