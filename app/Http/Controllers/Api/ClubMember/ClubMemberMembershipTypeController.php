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
     * @return void
     */
    public function store(Request $request, ClubMember $clubMember)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @param MembershipType $membershipType
     * @return void
     */
    public function show(ClubMember $clubMember, MembershipType $membershipType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ClubMember $clubMember
     * @param MembershipType $membershipType
     * @return void
     */
    public function update(Request $request, ClubMember $clubMember, MembershipType $membershipType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClubMember $clubMember
     * @param MembershipType $membershipType
     * @return void
     */
    public function destroy(ClubMember $clubMember, MembershipType $membershipType)
    {
        //
    }

    /**
     * @return array
     */
    private function validationRules()
    {
        return [
            'name' => 'required|min:2',
            'value' => 'required|min:1',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date',
        ];
    }
}
