<?php

namespace App\Http\Controllers\Web\MembershipTypeName;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class MembershipTypeNameController extends Controller
{
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
        return view('admin.membership-type-name.create');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        return view('admin.membership-type-name.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        return view('admin.membership-type-name.edit');
    }
}
