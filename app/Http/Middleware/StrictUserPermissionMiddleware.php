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
        $clubMemberIndex = null;

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

            if ($request->segments()) {
                foreach ($request->segments() as $key => $value) {
                    if ($value == "club-members") {
                        $clubMemberIndex = $key + 1;
                        break;
                    }
                }

                if ($request->segments()[$clubMemberIndex] || $request->segments()[$clubMemberIndex] != null ||
                    $request->segments()[$clubMemberIndex] != "") {

                    $club_member_uuid = $this->getClubMemberUUID($request->segments()[$clubMemberIndex]);
                    $user = User::query()->where('member_number', $club_member_uuid)->get()->first();

                    if ($user->member_number !== $request->user()->member_number) {
                        return $error;
                    }
                }
            }
        } else if ($request->user() && $club_member == null) {
            return $error;
        }

        return $next($request);
    }

    /**
     * @param $val
     * @return string
     */
    function getClubMemberUUID($val)
    {
        $club_member_uuid = $val;
        $club_member_uuid_arr = explode("-", $club_member_uuid);

        $club_id = $club_member_uuid_arr[count($club_member_uuid_arr) - 1];
        return rtrim($club_member_uuid, "-" . $club_id);
    }
}
