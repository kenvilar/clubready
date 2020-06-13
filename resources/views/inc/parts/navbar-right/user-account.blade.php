<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle padding-user d-block" data-toggle="dropdown">
        <img src="{{ asset('img/authors/avatar1.jpg') }}" width="35" class="rounded-circle img-fluid float-left"
             height="35" alt="User Image">
        <div class="riot">
            <div>
                @if (Auth::check())
                    {{ Auth::user()->{'first_name'} }} {{ Auth::user()->{'last_name'}  }}
                @endif
                <span><i class="fa fa-sort-down"></i></span>
            </div>
        </div>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <img src="{{ asset('img/authors/avatar1.jpg') }}" class="rounded-circle" alt="User Image">
            @if (Auth::check())
                <p>{{ Auth::user()->{'first_name'} }} {{ Auth::user()->{'last_name'}  }}</p>
            @endif
        </li>
        <!-- Menu Body -->
        <li class="p-t-3"><a href="{{ route('home') }}" class="dropdown-item"> <i class="fa fa-fw ti-user"></i> My Profile
            </a>
        </li>
        <li role="presentation"></li>
        <li><a href="#" class="dropdown-item"><i class="fa fa-fw ti-settings"></i> Account Settings </a></li>
        @if (!UserHelper::isSuperAdmin())
            <li><a href="{{route('chooseClub')}}" class="dropdown-item"><i class="fa fa-fw ti-settings"></i> Choose Club </a></li>
        @endif
        <li role="presentation" class="dropdown-divider"></li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="float-right" id="logout">
                <a @click="clickLogout" href>
                    <i class="fa fa-fw ti-shift-right"></i>
                    {{ __('Logout') }}
                </a>
            </div>
        </li>
    </ul>
</li>

@push('footer-scripts')
    <script>
        new Vue({
            el: '#logout',
            methods: {
                async clickLogout() {
                    axios.post(`/api/logoutapi`, '', {headers: {Authorization: 'Bearer ' + Laravel.apiToken}});
                    axios.post(`/logout`,);
                },
            }
        });
    </script>
@endpush
