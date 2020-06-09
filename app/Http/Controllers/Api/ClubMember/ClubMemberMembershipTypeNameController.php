<?php

namespace App\Http\Controllers\Api\ClubMember;

use App\Http\Controllers\ApiController;
use App\Models\ClubMember;
use App\Models\MembershipType;
use App\Models\MembershipTypeName;
use Illuminate\Http\Request;

class ClubMemberMembershipTypeNameController extends ApiController
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
        $membershipTypeNames = $clubMember->membershipTypeNames;

        return $this->showAll($membershipTypeNames);
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
        $membershipTypeName = MembershipTypeName::query()->create($data);

        return $this->showOne($membershipTypeName, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @param MembershipTypeName $membershipTypeName
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ClubMember $clubMember, MembershipTypeName $membershipTypeName)
    {
        $membershipTypeName = $clubMember->membershipTypeNames()->findOrFail($membershipTypeName->id);

        return $this->showOne($membershipTypeName);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ClubMember $clubMember
     * @param MembershipTypeName $membershipTypeName
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ClubMember $clubMember, MembershipTypeName $membershipTypeName)
    {
        $this->validate($request, $this->validationRules());

        foreach ($request->all() as $key => $value) {
            $membershipTypeName->$key = $value;
        }

        if (!$membershipTypeName->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $membershipTypeName->save();

        return $this->showOne($membershipTypeName);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClubMember $clubMember
     * @param MembershipTypeName $membershipTypeName
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(ClubMember $clubMember, MembershipTypeName $membershipTypeName)
    {
        $membershipTypeName = $clubMember->membershipTypeNames()->findOrFail($membershipTypeName->id);

        $membershipTypeName->delete();

        return $this->showOne($membershipTypeName);
    }

    /**
     * @return array
     */
    private function validationRules()
    {
        return [
            'name' => 'required|min:2',
        ];
    }
}
