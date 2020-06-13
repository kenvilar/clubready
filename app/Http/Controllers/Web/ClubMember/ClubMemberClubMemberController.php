<?php

namespace App\Http\Controllers\Web\ClubMember;

use App\Http\Controllers\Controller;
use App\Models\ClubMember;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ClubMemberClubMemberController extends Controller
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
        $this->middleware('club-admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param ClubMember $clubMember
     * @return Factory|View
     */
    public function index(ClubMember $clubMember)
    {
        return view('members.club-members.members.index', ['clubMember' => $clubMember]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ClubMember $clubMember
     * @return Factory|View
     */
    public function create(ClubMember $clubMember)
    {
        return view('members.club-members.members.createAndEditForm', ['clubMember' => $clubMember]);
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @return Factory|View
     */
    public function show(ClubMember $clubMember)
    {
        return view('members.club-members.members.show', ['clubMember' => $clubMember,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ClubMember $clubMember
     * @return Factory|View
     */
    public function edit(ClubMember $clubMember)
    {
        return view('members.club-members.members.createAndEditForm', ['clubMember' => $clubMember,]);
    }
}
