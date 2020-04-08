<?php

namespace App\Http\Controllers\Web\MembershipTypeName;

use App\Http\Controllers\Controller;
use App\Models\MembershipTypeName;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class MembershipTypeNameController extends Controller
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
        return view('admin.membership-type-name.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.membership-type-name.createAndEditForm');
    }

    /**
     * Display the specified resource.
     *
     * @param MembershipTypeName $membershipTypeName
     * @return Factory|View
     */
    public function show(MembershipTypeName $membershipTypeName)
    {
        return view('admin.membership-type-name.show', ['membershipTypeName' => $membershipTypeName]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MembershipTypeName $membershipTypeName
     * @return Factory|View
     */
    public function edit(MembershipTypeName $membershipTypeName)
    {
        return view('admin.membership-type-name.createAndEditForm', ['membershipTypeName' => $membershipTypeName]);
    }
}
