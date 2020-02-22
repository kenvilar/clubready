<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $superAdmins = SuperAdmin::all();

        return $this->showAll($superAdmins);
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
            'user_id' => 'integer|unique:super_admins,user_id',
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $superAdmin = SuperAdmin::query()->create($data);

        return $this->showOne($superAdmin, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param SuperAdmin $superAdmin
     * @return JsonResponse
     */
    public function show(SuperAdmin $superAdmin)
    {
        return $this->showOne($superAdmin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param SuperAdmin $superAdmin
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, SuperAdmin $superAdmin)
    {
        $rules = [
            'user_id' => 'integer|unique:super_admins,user_id',
        ];
        $this->validate($request, $rules);

        $superAdmin->save();

        return $this->showOne($superAdmin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SuperAdmin $superAdmin
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(SuperAdmin $superAdmin)
    {
        $superAdmin->delete();

        return $this->showOne($superAdmin);
    }
}
