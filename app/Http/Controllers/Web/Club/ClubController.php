<?php

namespace App\Http\Controllers\Web\Club;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ClubController extends Controller
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
        $this->middleware('super-admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.clubs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.clubs.createAndEditForm');
    }

    /**
     * Display the specified resource.
     *
     * @param Club $club
     * @return Factory|View
     */
    public function show(Club $club)
    {
        return view('admin.clubs.show', ['club' => $club]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Club $club
     * @return Factory|View
     */
    public function edit(Club $club)
    {
        return view('admin.clubs.createAndEditForm', ['club' => $club]);
    }
}
