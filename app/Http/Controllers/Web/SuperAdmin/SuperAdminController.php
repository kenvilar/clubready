<?php

namespace App\Http\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.super-admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.super-admin.createAndEditForm');
    }

    /**
     * Display the specified resource.
     *
     * @param SuperAdmin $superAdmin
     * @return Factory|View
     */
    public function show(SuperAdmin $superAdmin)
    {
        return view('admin.super-admin.show', ['superAdmin' => $superAdmin]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SuperAdmin $superAdmin
     * @return Factory|View
     */
    public function edit(SuperAdmin $superAdmin)
    {
        return view('admin.super-admin.createAndEditForm', ['superAdmin' => $superAdmin]);
    }
}
