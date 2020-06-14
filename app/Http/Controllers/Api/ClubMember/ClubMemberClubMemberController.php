<?php

namespace App\Http\Controllers\Api\ClubMember;

use App\Http\Controllers\ApiController;
use App\Models\ClubMember;
use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ClubMemberClubMemberController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('member-has-club');
        $this->middleware('club-admin');
        $this->middleware('strict-user');
    }

    /**
     * Display a listing of the resource.
     *
     * @param ClubMember $clubMember
     * @return JsonResponse
     */
    public function index(ClubMember $clubMember)
    {
        $clubMembers = ClubMember::query()
            ->with([
                'user' => function ($q) {
                    $q->select(['id', 'first_name', 'last_name',]);
                },
                'club' => function ($q) {
                    $q->select(['id', 'name',]);
                },
            ])
            ->where('club_id', $clubMember->club_id)
            ->where('user_id', '<>', $clubMember->user_id)
            ->get();

        return $this->showAll($clubMembers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param ClubMember $clubMember
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request, ClubMember $clubMember)
    {
        $rules = [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'admin' => 'required|in:' . ClubMember::ADMIN_USER . ',' . ClubMember::NON_ADMIN_USER,
        ];

        // First, save the user
        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::VERIFIED_USER;
        $data['member_number'] = (string)Str::uuid();
        $data['admin'] = User::NON_ADMIN_USER;

        $user = User::query()->create($data);

        // Second, save the club member and assign it to current club
        $this->validate($request, $this->validationRules($request, $user, $clubMember));

        $data2['user_id'] = $user->id;
        $data2['club_id'] = $clubMember->club_id;
        $data2['admin'] = $request->admin;
        $clubMember = ClubMember::query()->create($data2);

        return $this->showOne($clubMember, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @param ClubMember $member
     * @return JsonResponse
     */
    public function show(ClubMember $clubMember, ClubMember $member)
    {
        $clubMember = $clubMember
            ->newModelQuery()
            ->with([
                'user' => function ($q) {
                    $q->select(['id', 'first_name', 'last_name',]);
                },
                'club' => function ($q) {
                    $q->select(['id', 'name',]);
                },
            ])
            ->find($member->id);

        return $this->showOne($clubMember);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ClubMember $clubMember
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, ClubMember $clubMember)
    {
        $this->validate($request, $this->validationRules($request, $clubMember));

        $clubMember->user_id = $request->user_id;
        $clubMember->club_id = $request->club_id;
        $clubMember->admin = $request->admin;

        if (!$clubMember->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $clubMember->save();

        return $this->showOne($clubMember);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClubMember $clubMember
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(ClubMember $clubMember)
    {
        $clubMember->delete();

        return $this->showOne($clubMember);
    }

    /**
     * Unverified a user instead of delete
     *
     * @param ClubMember $clubMember
     * @return JsonResponse
     * @throws \Exception
     */
    public function unverifiedUser(ClubMember $clubMember, $member)
    {
        $clubMember = ClubMember::query()->where('uuid', $member)->get()->first();
        $user = User::query()->findOrFail($clubMember->user_id);
        $user->verified = '0';
        $user->verification_token = User::generateVerificationCode();
        $user->save();

        return $this->showOne($user);
    }

    /**
     * @param Request $request
     * @param $user
     * @param null $clubMember
     * @return array
     */
    private function validationRules(Request $request, $user, $clubMember = null)
    {
        if ($request->method() == "POST") {
            $club_id_rule = Rule::unique('club_members')
                ->where(function (Builder $query) use ($request, $user, $clubMember) {
                    $query
                        ->where('user_id', $user->id)
                        ->where('club_id', $clubMember->club_id);
                });
        } else {
            $club_id_rule = Rule::unique('club_members')
                ->where(function (Builder $query) use ($request, $clubMember) {
                    $query
                        ->where('user_id', $request->user_id)
                        ->where('club_id', $request->club_id)
                        ->whereNotIn('id', [$clubMember->id]);
                });
        }

        return [
            'user_id' => 'integer',
            'club_id' => ['integer',
                //Don't save if both user_id and club_id exist
                $club_id_rule,],
        ];
    }
}
