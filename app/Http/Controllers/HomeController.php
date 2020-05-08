<?php

namespace App\Http\Controllers;

use App\Models\ClubMember;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;

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
        $this->middleware('member-has-club')->except(['chooseClub', 'selectedClub',]);
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
        $clubs = ClubMember::query()
            ->where('user_id', auth()->user()->id)
            ->with([
                'club' => function ($q) {
                    $q->select(['id', 'name',]);
                },
            ])->get(['id', 'user_id', 'club_id',]);

        if ($super_admin->count()) {
            return redirect('/admin');
        }

        return view('auth.members-choose-club', ['clubs' => $clubs]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function selectedClub(Request $request)
    {
        if ($request->has('club_id')) {
            $request->session()->put('my_app__member__club_id', $request->input('club_id'));
        }

        return redirect()->route('home');
    }
}
