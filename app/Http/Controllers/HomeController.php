<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('member-has-club')->except(['chooseClub']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chooseClub()
    {
        $super_admin = SuperAdmin::query()->where('user_id', auth()->user()->id);

        if ($super_admin->count()) {
            return redirect('/admin');
        }

        return view('auth.members-choose-club');
    }
}
