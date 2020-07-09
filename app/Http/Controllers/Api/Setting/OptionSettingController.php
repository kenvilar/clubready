<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\ApiController;
use App\Models\Setting;
use Illuminate\Http\Request;

class OptionSettingController extends ApiController
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
     * Display the specified resource.
     *
     * @param Setting $setting
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Setting $setting)
    {
        return $this->showOne($setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Setting $setting)
    {
        foreach ($request->all() as $key => $value) {
            $setting->$key = $value;
        }

        if (!$setting->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $setting->save();

        return $this->showOne($setting);
    }
}
