<?php

namespace App\Http\Controllers\Web\MembershipType;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class MembershipTypeController extends Controller
{
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
        return view('admin.membership-type.create');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        return view('admin.membership-type.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        return view('admin.membership-type.edit');
    }
}
