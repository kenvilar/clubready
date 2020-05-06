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
     * @param Membership $membership
     * @return void
     */
    public function show(ClubMember $clubMember, Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ClubMember $clubMember
     * @param Membership $membership
     * @return void
     */
    public function update(Request $request, ClubMember $clubMember, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClubMember $clubMember
     * @param Membership $membership
     * @return void
     */
    public function destroy(ClubMember $clubMember, Membership $membership)
    {
        //
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
