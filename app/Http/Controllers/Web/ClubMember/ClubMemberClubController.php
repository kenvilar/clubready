<?php

namespace App\Http\Controllers\Web\ClubMember;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\ClubMember;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ClubMemberClubController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @param Club $club
     * @return Factory|View
     */
    public function show(ClubMember $clubMember, Club $club)
    {
        return view('members.club-members.clubs.show', ['clubMember' => $clubMember, 'club' => $club]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ClubMember $clubMember
     * @param Club $club
     * @return Factory|View
     */
    public function edit(ClubMember $clubMember, Club $club)
    {
        return view('members.club-members.clubs.edit',
            ['clubMember' => $clubMember, 'club' => $club]);
    }
}
