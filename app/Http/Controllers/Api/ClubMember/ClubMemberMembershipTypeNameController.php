<?php

namespace App\Http\Controllers\Api\ClubMember;

use App\Http\Controllers\ApiController;
use App\Models\ClubMember;
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
     * @return void
     */
    public function index(ClubMember $clubMember)
    {
        //
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
     * @param MembershipTypeName $membershipTypeName
     * @return void
     */
    public function show(ClubMember $clubMember, MembershipTypeName $membershipTypeName)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ClubMember $clubMember
     * @param MembershipTypeName $membershipTypeName
     * @return void
     */
    public function update(Request $request, ClubMember $clubMember, MembershipTypeName $membershipTypeName)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClubMember $clubMember
     * @param MembershipTypeName $membershipTypeName
     * @return void
     */
    public function destroy(ClubMember $clubMember, MembershipTypeName $membershipTypeName)
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
        ];
    }
}
