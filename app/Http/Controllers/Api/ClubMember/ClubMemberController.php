<?php

namespace App\Http\Controllers\Api\ClubMember;

use App\Http\Controllers\ApiController;
use App\Models\ClubMember;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ClubMemberController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('client');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $clubMembers = ClubMember::query()
            ->with([
                'user' => function ($q) {
                    $q->select(['id', 'first_name', 'last_name',]);
                },
                'club' => function ($q) {
                    $q->select(['id', 'name',]);
                },
            ])->get();

        return $this->showAll($clubMembers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules($request));

        $data = $request->all();
        $clubMember = ClubMember::query()->create($data);

        return $this->showOne($clubMember, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @return JsonResponse
     */
    public function show(ClubMember $clubMember)
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
            ->find($clubMember)
            ->shift();

        return $clubMember;
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
        $this->validate($request, $this->validationRules($request));

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

    private function validationRules(Request $request)
    {
        return [
            'user_id' => 'required|integer',
            'club_id' => ['required', 'integer',
                //Don't save if both user_id and club_id exist
                Rule::unique('club_members')->where(function (Builder $query) use ($request) {
                    $query
                        ->where('user_id', $request->user_id)
                        ->where('club_id', $request->club_id);
                }),],
            'admin' => 'required|in:' . ClubMember::ADMIN_USER . ',' . ClubMember::NON_ADMIN_USER,
        ];
    }
}
