<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\ApiController;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
     * @return JsonResponse
     */
    public function show(Setting $setting)
    {
        return $this->showOne($setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Setting $setting
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Setting $setting)
    {
        $logo = Str::contains($request->logo, 'data:') && Str::contains($request->logo, ';base64,');
        $favicon = Str::contains($request->favicon, 'data:') && Str::contains($request->favicon, ';base64,');

        if ($logo || $favicon) {
            $this->validate($request, $this->validationRules());
        }

        if ($setting->logo &&
            Str::contains($request->logo, 'data:') &&
            Str::contains($request->logo, ';base64,')) {
            Storage::delete('public/' . $setting->logo);
        }

        if ($setting->favicon &&
            Str::contains($request->favicon, 'data:') &&
            Str::contains($request->favicon, ';base64,')) {
            Storage::delete('public/' . $setting->favicon);
        }

        $setting->site_name = $request->site_name;
        $setting->logo = $request->logo;
        $setting->favicon = $request->favicon;

        $fileName = null;
        $fileNameFavicon = null;

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
            // $path = public_path('storage') . '/' . $fileName;
            $path = 'public/' . $fileName;
            Storage::put($path, $decoded);

            $setting->logo = $fileName;
        }

        if ($request->favicon &&
            Str::contains($request->favicon, 'data:') &&
            Str::contains($request->favicon, ';base64,')) {

            $explodedFavicon = explode(',', $request->favicon);
            $decodedFavicon = base64_decode($explodedFavicon[1]);
            if (Str::contains($explodedFavicon[0], '.icon')) {
                $extensionFavicon = "ico";
            }

            $fileNameFavicon = date('Y-m-d-His') . '.' . $extensionFavicon;
            $pathFavicon = 'public/' . $fileNameFavicon;
            Storage::put($pathFavicon, $decodedFavicon);

            $setting->favicon = $fileNameFavicon;
        }

        if (!$setting->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $setting->save();

        return $this->showOne($setting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Setting $setting
     * @return JsonResponse
     */
    public function destroy(Setting $setting)
    {
        if ($setting->logo) {
            Storage::delete('public/' . $setting->logo);
            $setting->logo = null;
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
            'logo' => 'image64:jpeg,jpg,png,gif|nullable',
            'favicon' => 'image64:vnd.microsoft.icon,x-icon,jpeg,jpg,png|nullable',
        ];
    }
}
