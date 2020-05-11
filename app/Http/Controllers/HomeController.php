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
            ])->get();

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
        $club = [];
        $club['admin'] = $request->input('admin');
        $club['club_id'] = $request->input('club_id');
        $club['id'] = $request->input('id');
        $club['user_id'] = $request->input('user_id');
        $club['uuid'] = $request->input('uuid');

        if ($request->has('uuid')) {
            $request->session()->put('my_app__current_member', $request->toArray());
        }

        return redirect()->route('home');
    }

    /**
     * @return array
     */
    public function getAllSessionData()
    {
        return session()->all();
    }
}
