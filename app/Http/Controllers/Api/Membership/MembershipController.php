<?php

namespace App\Http\Controllers\Api\Membership;

use App\Http\Controllers\ApiController;
use App\Models\Membership;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MembershipController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('client');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $memberships = Membership::all();

        return $this->showAll($memberships);
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
        $membership = Membership::query()->create($data);

        return $this->showOne($membership, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Membership $membership
     * @return JsonResponse
     */
    public function show(Membership $membership)
    {
        return $this->showOne($membership);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Membership $membership
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Membership $membership)
    {
        $this->validate($request, $this->validationRules());

        $membership->year = $request->year;
        $membership->name = $request->name;
        $membership->amount = $request->amount;

        if (!$membership->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $membership->save();

        return $this->showOne($membership);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Membership $membership
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Membership $membership)
    {
        $membership->delete();

        return $this->showOne($membership);
    }

    private function validationRules()
    {
        return [
            'year' => 'required|min:4|max:4',
            'name' => 'required|min:2',
            'amount' => 'required|numeric|min:1',
        ];
    }
}
