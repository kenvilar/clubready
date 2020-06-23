<li class="{{request()->routeIs('web.passport.*') ? 'active' : ''}} menu-dropdown" id="active">
    <a>
        <i class="menu-icon ti-settings"></i>
        <span class="mm-text ">Passports</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="{{request()->routeIs('web.passport.passport-clients') ? 'active' : ''}}">
            <a href="{{route('web.passport.passport-clients')}}">
                <i class="menu-icon ti-settings"></i> Passport Clients
            </a>
        </li>
        <li class="{{request()->routeIs('web.passport.passport-authorized-clients') ? 'active' : ''}}">
            <a href="{{route('web.passport.passport-authorized-clients')}}">
                <i class="menu-icon ti-settings"></i> Passport Authorized Clients
            </a>
        </li>
        <li class="{{request()->routeIs('web.passport.passport-personal-access-tokens') ? 'active' : ''}}">
            <a href="{{route('web.passport.passport-personal-access-tokens')}}">
                <i class="menu-icon ti-settings"></i> Passport Personal Access Tokens
            </a>
        </li>
    </ul>
</li>
<li class="{{request()->routeIs('web.user.*') ? 'active' : ''}} menu-dropdown">
    <a href="">
        <i class="menu-icon ti-user"></i>
        <span class="mm-text">Users</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="{{request()->routeIs('web.user.index') && request()->input('users') == 'all' ? 'active' : ''}}">
            <a href="{{route('web.user.index', ['users' => 'all'])}}">
                <i class="menu-icon ti-user"></i> Users
            </a>
        </li>
        <li class="{{request()->routeIs('web.user.index') && request()->input('users') == 'verified' ? 'active' : ''}}">
            <a href="{{route('web.user.index', ['users' => 'verified'])}}">
                <i class="menu-icon ti-user"></i> Verified Users
            </a>
        </li>
        <li class="{{request()->routeIs('web.user.index') && request()->input('users') == 'unverified' ? 'active' : ''}}">
            <a href="{{route('web.user.index', ['users' => 'unverified'])}}">
                <i class="menu-icon ti-user"></i> Unverified Users
            </a>
        </li>
    </ul>
</li>
<li class="{{request()->routeIs('web.super-admin.*') ? 'active' : ''}}">
    <a href="{{ route('web.super-admin.index') }}">
        <i class="menu-icon fa fa-fw fa-users"></i>
        <span class="mm-text ">Super Admins</span>
    </a>
</li>
<li class="{{request()->routeIs('web.club-member.*') ? 'active' : ''}}">
    <a href="{{ route('web.club-member.index') }}">
        <i class="menu-icon icon-people icons"></i>
        <span class="mm-text ">Club Members</span>
    </a>
</li>
<li class="{{request()->routeIs('web.club.*') ? 'active' : ''}}">
    <a href="{{ route('web.club.index') }}">
        <i class="menu-icon ti-desktop"></i>
        <span class="mm-text ">Clubs</span>
    </a>
</li>
<li class="{{request()->routeIs('web.membership.*') ? 'active' : ''}}">
    <a href="{{ route('web.membership.index') }}">
        <i class="menu-icon ti-tag"></i>
        <span class="mm-text ">Memberships</span>
    </a>
</li>
<li class="{{request()->routeIs('web.membership-type.*') ? 'active' : ''}}">
    <a href="{{ route('web.membership-type.index') }}">
        <i class="menu-icon ti-bookmark-alt"></i>
        <span class="mm-text ">Membership Types</span>
    </a>
</li>
<li class="{{request()->routeIs('web.membership-type-name.*') ? 'active' : ''}}">
    <a href="{{ route('web.membership-type-name.index') }}">
        <i class="menu-icon ti-id-badge"></i>
        <span class="mm-text ">Membership Type Names</span>
    </a>
</li>

<li class="{{request()->routeIs('web.vehicle.*') ? 'active' : ''}}">
    <a href="{{ route('web.vehicle.index') }}">
        <i class="menu-icon ti-car"></i>
        <span class="mm-text ">Vehicles</span>
    </a>
</li>
<li class="{{request()->routeIs('web.induction.*') ? 'active' : ''}}">
    <a href="{{ route('web.induction.index') }}">
        <i class="menu-icon fa fa-fw fa-tachometer"></i>
        <span class="mm-text ">Inductions</span>
    </a>
</li>
