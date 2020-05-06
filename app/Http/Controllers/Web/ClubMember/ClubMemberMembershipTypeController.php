<?php

namespace App\Http\Controllers\Web\ClubMember;

use App\Http\Controllers\Controller;
use App\Models\ClubMember;
use App\Models\MembershipType;

class ClubMemberMembershipTypeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        return view('members.club-members.membership-types.index', ['clubMember' => $clubMember]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ClubMember $clubMember
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ClubMember $clubMember)
    {
        return view('members.club-members.membership-types.createAndEditForm', ['clubMember' => $clubMember]);
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @param MembershipType $membershipType
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ClubMember $clubMember, MembershipType $membershipType)
    {
        return view('members.club-members.membership-types.show',
            ['clubMember' => $clubMember, 'membershipType' => $membershipType]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ClubMember $clubMember
     * @param MembershipType $membershipType
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ClubMember $clubMember, MembershipType $membershipType)
    {
        return view('members.club-members.membership-types.createAndEditForm',
            ['clubMember' => $clubMember, 'membershipType' => $membershipType]);
    }
}
