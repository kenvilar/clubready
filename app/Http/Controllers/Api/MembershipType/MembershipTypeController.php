<?php

namespace App\Http\Controllers\Api\MembershipType;

use App\Http\Controllers\Controller;
use App\Models\MembershipType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MembershipTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $membershipTypes = MembershipType::all();

        return $this->showAll($membershipTypes);
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
        $rules = [
            'name' => 'required|min:2',
            'value' => 'required|min:1',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date',
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $induction = MembershipType::query()->create($data);

        return $this->showOne($induction, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param MembershipType $membershipType
     * @return JsonResponse
     */
    public function show(MembershipType $membershipType)
    {
        return $this->showOne($membershipType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MembershipType $membershipType
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, MembershipType $membershipType)
    {
        $rules = [
            'name' => 'required|min:2',
            'value' => 'required|min:1',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date',
        ];
        $this->validate($request, $rules);

        $membershipType->name = $request->name;
        $membershipType->value = $request->value;
        $membershipType->start_date = $request->start_date;
        $membershipType->expiry_date = $request->expiry_date;

        if (!$membershipType->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $membershipType->save();

        return $this->showOne($membershipType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MembershipType $membershipType
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(MembershipType $membershipType)
    {
        $membershipType->delete();

        return $this->showOne($membershipType);
    }
}
