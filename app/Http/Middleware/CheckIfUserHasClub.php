<?php

namespace App\Http\Middleware;

use App\Models\ClubMember;
use Closure;

class CheckIfUserHasClub
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
        $club_member = ClubMember::query()->where('user_id', $request->user()->id);
        if ($club_member->count()) {
            if (!session()->has('my_app__current_member') && $request->acceptsHtml() && collect($request->route()->middleware())->contains('web')) {
                return redirect('/admin/choose-club');
            }
        }

        return $next($request);
    }
}
