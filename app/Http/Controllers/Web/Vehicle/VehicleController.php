<?php

namespace App\Http\Controllers\Web\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.vehicle.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.vehicle.createAndEditForm');
    }

    /**
     * Display the specified resource.
     *
     * @param Vehicle $vehicle
     * @return Factory|View
     */
    public function show(Vehicle $vehicle)
    {
        return view('admin.vehicle.show', ['vehicle' => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Vehicle $vehicle
     * @return Factory|View
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicle.createAndEditForm', ['vehicle' => $vehicle]);
    }
}
