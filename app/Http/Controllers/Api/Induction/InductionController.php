<?php

namespace App\Http\Controllers\Api\Induction;

use App\Http\Controllers\ApiController;
use App\Models\Induction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InductionController extends ApiController
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
        $this->validate($request, $this->validationRules());

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
        $this->validate($request, $this->validationRules());

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

    /**
     * @return array
     */
    private function validationRules()
    {
        return [
            'name' => 'required|min:2',
        ];
    }
}
