<?php

namespace App\Http\Controllers\Api\ClubMember;

use App\Http\Controllers\ApiController;
use App\Models\ClubMember;
use App\Models\MembershipType;
use Illuminate\Http\Request;

class ClubMemberMembershipTypeController extends ApiController
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
        $membershipTypes = $clubMember->membershipTypes;

        return $this->showAll($membershipTypes);
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
        $membership = MembershipType::query()->create($data);

        return $this->showOne($membership, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @param MembershipType $membershipType
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ClubMember $clubMember, MembershipType $membershipType)
    {
        $membershipType = $clubMember->membershipTypes()->findOrFail($membershipType->id);

        return $this->showOne($membershipType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ClubMember $clubMember
     * @param MembershipType $membershipType
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ClubMember $clubMember, MembershipType $membershipType)
    {
        $this->validate($request, $this->validationRules());

        foreach ($request->all() as $key => $value) {
            $membershipType->$key = $value;
        }

        if (!$membershipType->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $membershipType->save();

        return $this->showOne($membershipType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClubMember $clubMember
     * @param MembershipType $membershipType
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(ClubMember $clubMember, MembershipType $membershipType)
    {
        $membershipType = $clubMember->membershipTypes()->findOrFail($membershipType->id);

        $membershipType->delete();

        return $this->showOne($membershipType);
    }

    /**
     * @return array
     */
    private function validationRules()
    {
        return [
            'name' => 'required',
            'value' => 'required',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date',
        ];
    }
}
