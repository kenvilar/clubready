<?php

namespace App\Http\Controllers\Api\ClubMember;

use App\Http\Controllers\ApiController;
use App\Models\ClubMember;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ClubMemberVehicleController extends ApiController
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
        $this->middleware('strict-user');
    }

    /**
     * Display a listing of the resource.
     * @param ClubMember $clubMember
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ClubMember $clubMember)
    {
        $vehicles = $clubMember->vehicles;

        return $this->showAll($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ClubMember $clubMember
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, ClubMember $clubMember)
    {
        $this->validate($request, $this->validationRules());
        $data = $request->all();
        $data['club_member_id'] = $clubMember->id;
        $vehicle = Vehicle::query()->create($data);

        return $this->showOne($vehicle, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @param Vehicle $vehicle
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ClubMember $clubMember, Vehicle $vehicle)
    {
        $vehicle = $clubMember->vehicles()->findOrFail($vehicle->id);

        return $this->showOne($vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ClubMember $clubMember
     * @param Vehicle $vehicle
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ClubMember $clubMember, Vehicle $vehicle)
    {
        $this->validate($request, $this->validationRules());

        foreach ($request->all() as $key => $value) {
            $vehicle->$key = $value;
        }

        if (!$vehicle->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $vehicle->save();

        return $this->showOne($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClubMember $clubMember
     * @param Vehicle $vehicle
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(ClubMember $clubMember, Vehicle $vehicle)
    {
        $vehicle = $clubMember->vehicles()->findOrFail($vehicle->id);

        $vehicle->delete();

        return $this->showOne($vehicle);
    }

    /**
     * @return array
     */
    private function validationRules()
    {
        $now = date('Y');
        $nowPlus10 = (String)((int)$now + 10);

        return [
            'make' => 'required',
            'model' => 'required',
            'year' => 'required|integer|between:1700,' . $nowPlus10,
            'capacity' => 'required|integer',
            'induction' => 'required',
        ];
    }
}
