<?php

namespace App\Http\Controllers\Api\MembershipTypeName;

use App\Http\Controllers\ApiController;
use App\Models\MembershipTypeName;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MembershipTypeNameController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('client');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $membershipTypeNames = MembershipTypeName::all();

        return $this->showAll($membershipTypeNames);
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
        $membershipTypeName = MembershipTypeName::query()->create($data);

        return $this->showOne($membershipTypeName, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param MembershipTypeName $membershipTypeName
     * @return JsonResponse
     */
    public function show(MembershipTypeName $membershipTypeName)
    {
        return $this->showOne($membershipTypeName);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MembershipTypeName $membershipTypeName
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, MembershipTypeName $membershipTypeName)
    {
        $this->validate($request, $this->validationRules());

        $membershipTypeName->name = $request->name;

        if (!$membershipTypeName->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $membershipTypeName->save();

        return $this->showOne($membershipTypeName);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MembershipTypeName $membershipTypeName
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(MembershipTypeName $membershipTypeName)
    {
        $membershipTypeName->delete();

        return $this->showOne($membershipTypeName);
    }

    private function validationRules()
    {
        return [
            'name' => 'required|min:2',
        ];
    }
}
