<?php

namespace App\Http\Controllers\Api\Club;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $clubs = Club::all();

        return $this->showAll($clubs);
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
            'address' => 'required|min:2',
            'suburb' => 'required|min:2',
            'state' => 'required|min:2',
            'postcode' => 'required|min:4|max:12',
            'country' => 'required|min:2',
            //'phone' => 'required',
            'email' => 'email',
            //'website' => 'required',
            //'stripe_keys' => 'required',
        ];
        $this->validate($request, $rules);
        $data = $request->all();

        $club = Club::query()->create($data);

        return $this->showOne($club, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Club $club
     * @return JsonResponse
     */
    public function show(Club $club)
    {
        return $this->showOne($club);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Club $club
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Club $club)
    {
        $rules = [
            'name' => 'required|min:2',
            'address' => 'required|min:2',
            'suburb' => 'required|min:2',
            'state' => 'required|min:2',
            'postcode' => 'required|min:4|max:12',
            'country' => 'required|min:2',
            //'phone' => 'required',
            'email' => 'email',
            //'website' => 'required',
            //'stripe_keys' => 'required',
        ];

        $this->validate($request, $rules);

        $club->name = $request->name;
        $club->address = $request->address;
        $club->suburb = $request->suburb;
        $club->state = $request->state;
        $club->postcode = $request->postcode;
        $club->country = $request->country;
        $club->email = $request->email;

        if (!$club->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $club->save();

        return $this->showOne($club);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Club $club
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Club $club)
    {
        $club->delete();

        return $this->showOne($club);
    }
}
