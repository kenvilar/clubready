<?php

namespace App\Http\Controllers\Web\Induction;

use App\Http\Controllers\Controller;
use App\Models\Induction;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class InductionController extends Controller
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
        return view('admin.induction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.induction.createAndEditForm');
    }

    /**
     * Display the specified resource.
     *
     * @param Induction $induction
     * @return Factory|View
     */
    public function show(Induction $induction)
    {
        return view('admin.induction.show', ['induction' => $induction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Induction $induction
     * @return Factory|View
     */
    public function edit(Induction $induction)
    {
        return view('admin.induction.createAndEditForm', ['induction' => $induction]);
    }
}
