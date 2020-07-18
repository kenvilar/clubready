<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\ApiController;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Setting $setting)
    {
        if (Str::contains($request->logo, 'data:') && Str::contains($request->logo, ';base64,')) {
            $this->validate($request, $this->validationRules());
        }

        $setting->site_name = $request->site_name;
        $setting->logo = $request->logo;

        $fileName = null;

        if ($request->logo &&
            Str::contains($request->logo, 'data:') &&
            Str::contains($request->logo, ';base64,')) {

            $exploded = explode(',', $request->logo);
            $decoded = base64_decode($exploded[1]);
            if (Str::contains($exploded[0], 'jpeg')) {
                $extension = "jpeg";
            } else if (Str::contains($exploded[0], 'jpg')) {
                $extension = "jpg";
            } else if (Str::contains($exploded[0], 'png')) {
                $extension = "png";
            } else if (Str::contains($exploded[0], 'gif')) {
                $extension = "gif";
            }

            $fileName = date('Y-m-d-His') . '.' . $extension;
            $path = public_path('storage') . '/' . $fileName;
            file_put_contents($path, $decoded);

            $setting->logo = $fileName;
        }

        if (!$setting->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $setting->save();

        return $this->showOne($setting);
    }

    /**
     * @return array
     */
    private function validationRules()
    {
        return [
            'logo' => 'image64:jpeg,jpg,png,gif',
        ];
    }
}
