@if (env('APP_DEBUG'))
    <li class="{{request()->routeIs('getAllSessionData') ? 'active' : ''}}">
        <a href="{{ route('getAllSessionData') }}" target="_blank">
            <i class="menu-icon ti-tag"></i>
            <span class="mm-text ">All Session Data</span>
        </a>
    </li>
@endif
@if (UserHelper::isClubAdmin() && session()->has('my_app__current_member'))
    <li class="{{request()->routeIs('web.club-member.clubs.*') ? 'active' : ''}}">
        <a href="{{ route('web.club-member.clubs.show', [session('my_app__current_member')['uuid'], UserHelper::getClub()->uuid]) }}">
            <i class="menu-icon icon-organization icons"></i>
            <span class="mm-text ">Club Details</span>
        </a>
    </li>
    <li class="{{request()->routeIs('web.club-member.members.*') ? 'active' : ''}} menu-dropdown">
        <a href="">
            <i class="menu-icon icon-people icons"></i>
            <span class="mm-text">Club Members</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="{{request()->routeIs('web.club-member.members.index') && request()->input('users') != 'deleted' ? 'active' : ''}}">
                <a href="{{route('web.club-member.members.index', session('my_app__current_member')['uuid'])}}">
                    <i class="menu-icon ti-user"></i> Active
                </a>
            </li>
            <li class="{{request()->routeIs('web.club-member.members.index') && request()->input('users') == 'deleted' ? 'active' : ''}}">
                <a href="{{route('web.club-member.members.index', [session('my_app__current_member')['uuid'], 'users' => 'deleted'])}}">
                    <i class="menu-icon ti-user"></i> Deleted
                </a>
            </li>
        </ul>
    </li>
@endif
@if (session()->has('my_app__current_member'))
    <li class="{{request()->routeIs('web.club-member.memberships.*') ? 'active' : ''}}">
        <a href="{{ route('web.club-member.memberships.index', session('my_app__current_member')['uuid']) }}">
            <i class="menu-icon ti-tag"></i>
            <span class="mm-text ">Memberships</span>
        </a>
    </li>
    <li class="{{request()->routeIs('web.club-member.membership-types.*') ? 'active' : ''}}">
        <a href="{{ route('web.club-member.membership-types.index', session('my_app__current_member')['uuid']) }}">
            <i class="menu-icon ti-bookmark-alt"></i>
            <span class="mm-text ">Membership Types</span>
        </a>
    </li>
    <li class="{{request()->routeIs('web.club-member.membership-type-names.*') ? 'active' : ''}}">
        <a href="{{ route('web.club-member.membership-type-names.index', session('my_app__current_member')['uuid']) }}">
            <i class="menu-icon ti-id-badge"></i>
            <span class="mm-text ">Membership Type Names</span>
        </a>
    </li>
    <li class="{{request()->routeIs('web.club-member.vehicles.*') ? 'active' : ''}}">
        <a href="{{ route('web.club-member.vehicles.index', session('my_app__current_member')['uuid']) }}">
            <i class="menu-icon ti-car"></i>
            <span class="mm-text ">Vehicles</span>
        </a>
    </li>
@endif
