<?php

namespace App\Http\Controllers\Web\Membership;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class MembershipController extends Controller
{
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
        return view('admin.membership.create');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        return view('admin.membership.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        return view('admin.membership.edit');
    }
}
