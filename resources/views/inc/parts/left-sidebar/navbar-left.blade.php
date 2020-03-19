<ul class="navigation">
    <li class="{{request()->routeIs('web.user.index') ? 'active' : ''}}" id="active">
        <a href="{{ route('web.user.index') }}">
            <i class="menu-icon ti-desktop"></i>
            <span class="mm-text ">Users</span>
        </a>
    </li>
    <li class="{{request()->routeIs('web.club.index') ? 'active' : ''}}">
        <a href="{{ route('web.club.index') }}">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Clubs</span>
        </a>
    </li>
    <li class="{{request()->routeIs('web.club-member.index') ? 'active' : ''}}">
        <a href="{{ route('web.club-member.index') }}">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Club Members</span>
        </a>
    </li>
    <li class="{{request()->routeIs('web.induction.index') ? 'active' : ''}}">
        <a href="{{ route('web.induction.index') }}">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Inductions</span>
        </a>
    </li>
    <li class="{{request()->routeIs('web.membership.index') ? 'active' : ''}}">
        <a href="{{ route('web.membership.index') }}">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Memberships</span>
        </a>
    </li>
    <li class="{{request()->routeIs('web.membership-type.index') ? 'active' : ''}}">
        <a href="{{ route('web.membership-type.index') }}">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Membership Types</span>
        </a>
    </li>
    <li class="{{request()->routeIs('web.membership-type-name.index') ? 'active' : ''}}">
        <a href="{{ route('web.membership-type-name.index') }}">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Membership Type Names</span>
        </a>
    </li>
    <li class="{{request()->routeIs('web.super-admin.index') ? 'active' : ''}}">
        <a href="{{ route('web.super-admin.index') }}">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Super Admins</span>
        </a>
    </li>
    <li class="{{request()->routeIs('web.vehicle.index') ? 'active' : ''}}">
        <a href="{{ route('web.vehicle.index') }}">
            <i class="menu-icon ti-layout-list-large-image"></i>
            <span class="mm-text ">Vehicles</span>
        </a>
    </li>
</ul>
