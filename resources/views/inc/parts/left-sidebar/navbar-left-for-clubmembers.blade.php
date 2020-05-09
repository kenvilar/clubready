@if (UserHelper::isClubAdmin())
    <li class="{{request()->routeIs('web.club-member.*') ? 'active' : ''}}">
        <a href="{{ route('web.club-member.index') }}">
            <i class="menu-icon icon-people icons"></i>
            <span class="mm-text ">Club Members</span>
        </a>
    </li>
@endif
<li class="{{request()->routeIs('web.club-member.memberships.*') ? 'active' : ''}}">
    <a href="{{ route('web.club-member.memberships.index',
                auth()->user()->member_number . '-' . session('my_app__member__club_id')) }}">
        <i class="menu-icon ti-tag"></i>
        <span class="mm-text ">Memberships</span>
    </a>
</li>
<li class="{{request()->routeIs('web.club-member.membership-types.*') ? 'active' : ''}}">
    <a href="{{ route('web.club-member.membership-types.index',
                auth()->user()->member_number . '-' . session('my_app__member__club_id')) }}">
        <i class="menu-icon ti-bookmark-alt"></i>
        <span class="mm-text ">Membership Types</span>
    </a>
</li>
<li class="{{request()->routeIs('web.club-member.membership-type-names.*') ? 'active' : ''}}">
    <a href="{{ route('web.club-member.membership-type-names.index',
                auth()->user()->member_number . '-' . session('my_app__member__club_id')) }}">
        <i class="menu-icon ti-id-badge"></i>
        <span class="mm-text ">Membership Type Names</span>
    </a>
</li>
<li class="{{request()->routeIs('web.club-member.vehicles.*') ? 'active' : ''}}">
    <a href="{{ route('web.club-member.vehicles.index',
                auth()->user()->member_number . '-' . session('my_app__member__club_id')) }}">
        <i class="menu-icon ti-car"></i>
        <span class="mm-text ">Vehicles</span>
    </a>
</li>
