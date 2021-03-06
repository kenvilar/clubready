<?php

namespace App\Http\Controllers\Api\Vehicle;

use App\Http\Controllers\ApiController;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VehicleController extends ApiController
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
     * @return JsonResponse
     */
    public function index()
    {
        $vehicles = Vehicle::query()
            ->with([
                'club_member' => function ($q) {
                    $q
                        ->with(['user' => function ($q) {
                            $q->select(['id', 'first_name', 'last_name',]);
                        }])
                        ->with(['club' => function ($q) {
                            $q->select(['id', 'name',]);
                        }])
                        ->select(['id', 'user_id', 'club_id',]);
                },
            ])
            ->get();

        return $this->showAll($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules());

        $data = $request->all();
        $vehicle = Vehicle::query()->create($data);

        return $this->showOne($vehicle, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Vehicle $vehicle
     * @return JsonResponse
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle = $vehicle
            ->newModelQuery()
            ->with([
                'club_member' => function ($q) {
                    $q->with(['user' => function ($q) {
                        $q->select(['id', 'first_name', 'last_name',]);
                    }])->select(['id', 'user_id',]);
                },
            ])
            ->find($vehicle->id);

        return $this->showOne($vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Vehicle $vehicle
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $this->validate($request, $this->validationRules());

        $vehicle->club_member_id = $request->club_member_id;
        $vehicle->make = $request->make;
        $vehicle->model = $request->model;
        $vehicle->year = $request->year;
        $vehicle->capacity = $request->capacity;
        $vehicle->induction = $request->induction;

        if (!$vehicle->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $vehicle->save();

        return $this->showOne($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vehicle $vehicle
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Vehicle $vehicle)
    {
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
            'club_member_id' => 'required|integer',
            'make' => 'required',
            'model' => 'required',
            'year' => 'required|integer|between:1700,' . $nowPlus10,
            'capacity' => 'required|integer|min:1',
            'induction' => 'required',
        ];
    }
}
