<?php

namespace App\Http\Controllers\Api\Club;

use App\Http\Controllers\ApiController;
use App\Models\Club;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClubController extends ApiController
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
        $columns = [];
        $clubs = Club::query()->get();

        //display specific columns
        if (\request()->all() && \request()->select == true) {
            foreach (\request()->all() as $key => $value) {
                if ($key !== 'select' && $value == 'true') {
                    array_push($columns, $key);
                }
            }

            $clubs = Club::query()->get($columns);
        }

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
        $this->validate($request, $this->validationRules());
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
        $this->validate($request, $this->validationRules());

        $club->name = $request->name;
        $club->address = $request->address;
        $club->suburb = $request->suburb;
        $club->state = $request->state;
        $club->postcode = $request->postcode;
        $club->country = $request->country;
        $club->phone = $request->phone;
        $club->email = $request->email;
        $club->website = $request->website;

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

    /**
     * @return array
     */
    private function validationRules()
    {
        return [
            'name' => 'required|min:2',
            'address' => 'required|min:2',
            'suburb' => 'required|min:2',
            'state' => 'required|min:2',
            'postcode' => 'required|min:4|max:12',
            'country' => 'required|min:2',
            'phone' => 'nullable|min:2',
            'email' => 'nullable|email',
            'website' => 'nullable|min:3',
            //'stripe_keys' => 'required',
        ];
    }
}
