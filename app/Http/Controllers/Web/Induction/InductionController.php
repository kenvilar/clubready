<?php

namespace App\Http\Controllers\Web\Induction;

use App\Http\Controllers\Controller;
use App\Models\Induction;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class InductionController extends Controller
{
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
        return view('admin.induction.createAndUpdateForm');
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
        return view('admin.induction.createAndUpdateForm', ['induction' => $induction]);
    }
}
