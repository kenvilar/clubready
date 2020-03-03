<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return $this->showAll($users);
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
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::NON_ADMIN_USER,

            'address' => 'nullable|min:2',
            'suburb' => 'nullable|min:2',
            'state' => 'nullable|min:2',
            'postcode' => 'nullable|min:4|max:12',
            'country' => 'nullable|min:2',
            'phone_home' => 'nullable|min:5',
            'phone_mobile' => 'nullable|min:5',
            'alternative_email' => 'nullable|email|min:4',
            'date_of_birth' => 'nullable|date',
            'active' => 'nullable|in:' . User::ACTIVE_USER . ',' . User::INACTIVE_USER,
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::VERIFIED_USER;
        $data['member_number'] = (string)Str::uuid();

        if ($data['verified'] == '0') {
            $data['verification_token'] = User::generateVerificationCode();
        }

        $data['admin'] = User::NON_ADMIN_USER;

        $user = User::query()->create($data);

        return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,' . $user->id,
            //'password' => 'nullable|min:6',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::NON_ADMIN_USER,

            'address' => 'nullable|min:2',
            'suburb' => 'nullable|min:2',
            'state' => 'nullable|min:2',
            'postcode' => 'nullable|min:4|max:12',
            'country' => 'nullable|min:2',
            'phone_home' => 'nullable|min:5',
            'phone_mobile' => 'nullable|min:5',
            'alternative_email' => 'nullable|email|min:4',
            'date_of_birth' => 'nullable|date',
            'active' => 'nullable|in:' . User::ACTIVE_USER . ',' . User::INACTIVE_USER,
        ];

        $this->validate($request, $rules);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        //$user->password = $request->password;
        $user->admin = $request->admin;
        $user->address = $request->address;
        $user->suburb = $request->suburb;
        $user->state = $request->state;
        $user->postcode = $request->postcode;
        $user->country = $request->country;
        $user->phone_home = $request->phone_home;
        $user->phone_mobile = $request->phone_mobile;
        $user->alternative_email = $request->alternative_email;
        $user->date_of_birth = $request->date_of_birth;
        $user->active = $request->active;

        if ($request->has('email') && $user->email !== $request->email) {
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {
            if (!$user->isVerified()) {
                return $this->errorResponse('Only verified users can modify the admin field', 409);
            }

            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $user->save();

        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->showOne($user);
    }
}
