<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle padding-user d-block" data-toggle="dropdown">
        <img src="{{ asset('img/authors/avatar1.jpg') }}" width="35" class="rounded-circle img-fluid float-left"
             height="35" alt="User Image">
        <div class="riot">
            <div>
                {{ Auth::user()->{'first_name'} }} {{ Auth::user()->{'last_name'}  }}
                <span><i class="fa fa-sort-down"></i></span>
            </div>
        </div>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <img src="{{ asset('img/authors/avatar1.jpg') }}" class="rounded-circle" alt="User Image">
            <p>{{ Auth::user()->{'first_name'} }} {{ Auth::user()->{'last_name'}  }}</p>
        </li>
        <!-- Menu Body -->
        <li class="p-t-3"><a href="{{ route('home') }}" class="dropdown-item"> <i class="fa fa-fw ti-user"></i> My Profile
            </a>
        </li>
        <li role="presentation"></li>
        <li><a href="#" class="dropdown-item"><i class="fa fa-fw ti-settings"></i> Account Settings </a>
        </li>
        <li role="presentation" class="dropdown-divider"></li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="float-right">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-fw ti-shift-right"></i>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</li>
