<?php

namespace App\Http\Controllers\Api\ClubMember;

use App\Http\Controllers\ApiController;
use App\Models\Club;
use App\Models\ClubMember;
use Illuminate\Http\Request;

class ClubMemberClubController extends ApiController
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
        $this->middleware('club-admin');
        $this->middleware('strict-user');
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @param Club $club
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ClubMember $clubMember, Club $club)
    {
        $club = Club::query()->find($clubMember->club_id);

        return $this->showOne($club);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ClubMember $clubMember
     * @param Club $club
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ClubMember $clubMember, Club $club)
    {
        $this->validate($request, $this->validationRules());

        foreach ($request->all() as $key => $value) {
            $club->$key = $value;
        }

        if (!$club->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $club->save();

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
