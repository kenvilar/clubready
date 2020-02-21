<?php

namespace App\Http\Controllers\Api\Induction;

use App\Http\Controllers\Controller;
use App\Models\Induction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $inductions = Induction::all();

        return $this->showAll($inductions);
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
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $induction = Induction::query()->create($data);

        return $this->showOne($induction, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Induction $induction
     * @return JsonResponse
     */
    public function show(Induction $induction)
    {
        return $this->showOne($induction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Induction $induction
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Induction $induction)
    {
        $rules = [
            'name' => 'required|min:2',
        ];
        $this->validate($request, $rules);

        $induction->name = $request->name;

        if (!$induction->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $induction->save();

        return $this->showOne($induction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Induction $induction
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Induction $induction)
    {
        $induction->delete();

        return $this->showOne($induction);
    }
}
