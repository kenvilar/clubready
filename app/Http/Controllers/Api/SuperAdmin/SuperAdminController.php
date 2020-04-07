<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\ApiController;
use App\Models\SuperAdmin;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SuperAdminController extends ApiController
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
        $columns = [];
        $superAdmins = SuperAdmin::query()
            ->with([
                'user' => function ($q) {
                    $q->select(['id', 'first_name', 'last_name',]);
                },
            ])->get();

        //display specific columns
        if (\request()->all() && \request()->select == true) {
            foreach (\request()->all() as $key => $value) {
                if ($key !== 'select' && $value == 'true') {
                    array_push($columns, $key);
                }
            }

            $superAdmins = SuperAdmin::query()
                ->with([
                    'user' => function ($q) {
                        $q->select(['id', 'first_name', 'last_name',]);
                    },
                ])->get($columns);
        }

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
        $this->validate($request, $this->validationRules());

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
        $superAdmin = $superAdmin
            ->newModelQuery()
            ->with([
                'user' => function ($q) {
                    $q->select(['id', 'first_name', 'last_name',]);
                },
            ])
            ->find($superAdmin)
            ->shift();

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
        $this->validate($request, $this->validationRules());

        $superAdmin->user_id = $request->user_id;

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

    private function validationRules()
    {
        return [
            'user_id' => 'required|integer|unique:super_admins,user_id',
        ];
    }
}
