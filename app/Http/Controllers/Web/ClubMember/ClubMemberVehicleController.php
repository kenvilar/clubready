<?php

namespace App\Http\Controllers\Web\ClubMember;

use App\Http\Controllers\Controller;
use App\Models\ClubMember;
use App\Models\Vehicle;

class ClubMemberVehicleController extends Controller
{
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
        return view('admin.club-members.vehicles.index', ['clubMember' => $clubMember]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ClubMember $clubMember
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ClubMember $clubMember)
    {
        return view('admin.club-members.vehicles.createAndEditForm', ['clubMember' => $clubMember]);
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @param Vehicle $vehicle
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ClubMember $clubMember, Vehicle $vehicle)
    {
        return view('admin.club-members.vehicles.show', ['clubMember' => $clubMember, 'vehicle' => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ClubMember $clubMember
     * @param Vehicle $vehicle
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ClubMember $clubMember, Vehicle $vehicle)
    {
        return view('admin.club-members.vehicles.createAndEditForm',
            ['clubMember' => $clubMember, 'vehicle' => $vehicle]);
    }
}
