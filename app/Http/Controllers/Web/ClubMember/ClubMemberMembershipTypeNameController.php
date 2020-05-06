<?php

namespace App\Http\Controllers\Web\ClubMember;

use App\Http\Controllers\Controller;
use App\Models\ClubMember;
use App\Models\MembershipTypeName;

class ClubMemberMembershipTypeNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ClubMember $clubMember
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ClubMember $clubMember)
    {
        return view('members.club-members.membership-type-names.index', ['clubMember' => $clubMember]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ClubMember $clubMember
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ClubMember $clubMember)
    {
        return view('members.club-members.membership-type-names.createAndEditForm', ['clubMember' => $clubMember]);
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @param MembershipTypeName $membershipTypeName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ClubMember $clubMember, MembershipTypeName $membershipTypeName)
    {
        return view('members.club-members.membership-type-names.show',
            ['clubMember' => $clubMember, 'membershipTypeName' => $membershipTypeName]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ClubMember $clubMember
     * @param MembershipTypeName $membershipTypeName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ClubMember $clubMember, MembershipTypeName $membershipTypeName)
    {
        return view('members.club-members.membership-type-names.createAndEditForm',
            ['clubMember' => $clubMember, 'membershipTypeName' => $membershipTypeName]);
    }
}
