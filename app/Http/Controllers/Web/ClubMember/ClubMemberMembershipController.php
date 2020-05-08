<?php

namespace App\Http\Controllers\Web\ClubMember;

use App\Http\Controllers\Controller;
use App\Models\ClubMember;
use App\Models\Membership;

class ClubMemberMembershipController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ClubMember $clubMember)
    {
        return view('members.club-members.memberships.index', ['clubMember' => $clubMember]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ClubMember $clubMember
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ClubMember $clubMember)
    {
        return view('members.club-members.memberships.createAndEditForm', ['clubMember' => $clubMember]);
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @param Membership $membership
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ClubMember $clubMember, Membership $membership)
    {
        return view('members.club-members.memberships.show',
            ['clubMember' => $clubMember, 'membership' => $membership]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ClubMember $clubMember
     * @param Membership $membership
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ClubMember $clubMember, Membership $membership)
    {
        return view('members.club-members.memberships.createAndEditForm',
            ['clubMember' => $clubMember, 'membership' => $membership]);
    }
}
