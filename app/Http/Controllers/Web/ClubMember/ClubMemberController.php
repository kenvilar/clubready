<?php

namespace App\Http\Controllers\Web\ClubMember;

use App\Http\Controllers\Controller;
use App\Models\ClubMember;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ClubMemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.club-members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.club-members.createAndEditForm');
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @return Factory|View
     */
    public function show(ClubMember $clubMember)
    {
        return view('admin.club-members.show', ['clubMember' => $clubMember]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ClubMember $clubMember
     * @return Factory|View
     */
    public function edit(ClubMember $clubMember)
    {
        return view('admin.club-members.createAndEditForm', ['clubMember' => $clubMember]);
    }
}
