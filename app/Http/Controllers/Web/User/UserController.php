<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.user.createAndEditForm');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        return view('admin.user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function edit(User $user)
    {
        return view('admin.user.createAndEditForm', ['user' => $user]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function userToken()
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Not authenticated user.', 'code' => 401], 401);
        }
        $user = auth()->user()->token;

        return response()->json($user, 200);
    }
}
