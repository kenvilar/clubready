<?php

namespace App\Http\Controllers\Api\ClubMember;

use App\Http\Controllers\ApiController;
use App\Models\ClubMember;
use App\Models\Membership;
use Illuminate\Http\Request;

class ClubMemberMembershipController extends ApiController
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
        $this->middleware('strict-user');
    }

    /**
     * Display a listing of the resource.
     *
     * @param ClubMember $clubMember
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ClubMember $clubMember)
    {
        $memberships = $clubMember->memberships;

        return $this->showAll($memberships);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ClubMember $clubMember
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, ClubMember $clubMember)
    {
        $this->validate($request, $this->validationRules());
        $data = $request->all();
        $data['club_member_id'] = $clubMember->id;
        $membership = Membership::query()->create($data);

        return $this->showOne($membership, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @param Membership $membership
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ClubMember $clubMember, Membership $membership)
    {
        $membership = $clubMember->memberships()->findOrFail($membership->id);

        return $this->showOne($membership);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ClubMember $clubMember
     * @param Membership $membership
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ClubMember $clubMember, Membership $membership)
    {
        $this->validate($request, $this->validationRules());

        foreach ($request->all() as $key => $value) {
            $membership->$key = $value;
        }

        if (!$membership->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $membership->save();

        return $this->showOne($membership);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClubMember $clubMember
     * @param Membership $membership
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(ClubMember $clubMember, Membership $membership)
    {
        $membership = $clubMember->memberships()->findOrFail($membership->id);

        $membership->delete();

        return $this->showOne($membership);
    }

    /**
     * @return array
     */
    private function validationRules()
    {
        return [
            'year' => 'required|min:4|max:4',
            'name' => 'required|min:2',
            'amount' => 'required|numeric|min:1',
        ];
    }
}
