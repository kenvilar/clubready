<?php

namespace App\Http\Controllers\Web\MembershipType;

use App\Http\Controllers\Controller;
use App\Models\MembershipType;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class MembershipTypeController extends Controller
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
        return view('admin.membership-type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.membership-type.createAndEditForm');
    }

    /**
     * Display the specified resource.
     *
     * @param MembershipType $membershipType
     * @return Factory|View
     */
    public function show(MembershipType $membershipType)
    {
        return view('admin.membership-type.show', ['membershipType' => $membershipType]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MembershipType $membershipType
     * @return Factory|View
     */
    public function edit(MembershipType $membershipType)
    {
        return view('admin.membership-type.createAndEditForm', ['membershipType' => $membershipType]);
    }
}
