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
