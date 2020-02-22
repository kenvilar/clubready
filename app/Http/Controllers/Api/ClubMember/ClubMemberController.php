<?php

namespace App\Http\Controllers\Api\ClubMember;

use App\Http\Controllers\Controller;
use App\Models\ClubMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClubMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $clubMembers = ClubMember::all();

        return $this->showAll($clubMembers);
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
            'user_id' => 'required|integer',
            'club_id' => 'required|integer',
            'admin' => 'in:' . ClubMember::ADMIN_USER . ',' . ClubMember::NON_ADMIN_USER,
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $clubMember = ClubMember::query()->create($data);

        return $this->showOne($clubMember, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param ClubMember $clubMember
     * @return JsonResponse
     */
    public function show(ClubMember $clubMember)
    {
        return $this->showOne($clubMember);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ClubMember $clubMember
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, ClubMember $clubMember)
    {
        $rules = [
            'user_id' => 'required|integer',
            'club_id' => 'required|integer',
            'admin' => 'in:' . ClubMember::ADMIN_USER . ',' . ClubMember::NON_ADMIN_USER,
        ];
        $this->validate($request, $rules);

        $clubMember->user_id = $request->user_id;
        $clubMember->club_id = $request->club_id;
        $clubMember->admin = $request->admin;

        if (!$clubMember->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $clubMember->save();

        return $this->showOne($clubMember);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClubMember $clubMember
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(ClubMember $clubMember)
    {
        $clubMember->delete();

        return $this->showOne($clubMember);
    }
}
