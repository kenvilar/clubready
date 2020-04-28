<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Response;

class ClubAdminMiddleware
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
            $error = new Response(view('auth.unauthorized')->with('role', 'CLUB ADMIN'));
        } else {
            $error = redirect('/');
        }

        if (!$request->acceptsHtml() || !collect($request->route()->middleware())->contains('web')) {
            $error = response()
                ->json([
                    'error' => 'You cannot access this page! This is for only CLUB ADMIN.',
                    'code' => 403
                ], 403);
        }

        if ($request->user() && $club_member != null) {
            if ($club_member->admin != 1) {
                return $error;
            }
        } else if ($request->user() && $club_member == null) {
            return $error;
        }

        return $next($request);
    }
}
