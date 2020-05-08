<?php

namespace App\Http\Controllers\Web\Membership;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class MembershipController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('super-admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.membership.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.membership.createAndEditForm');
    }

    /**
     * Display the specified resource.
     *
     * @param Membership $membership
     * @return Factory|View
     */
    public function show(Membership $membership)
    {
        return view('admin.membership.show', ['membership' => $membership]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Membership $membership
     * @return Factory|View
     */
    public function edit(Membership $membership)
    {
        return view('admin.membership.createAndEditForm', ['membership' => $membership]);
    }
}
