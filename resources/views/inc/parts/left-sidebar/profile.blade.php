<div class="nav_profile">
    <div class="media profile-left">
        <a class="float-left profile-thumb" href="#">
            <img src="{{ asset('img/authors/avatar1.jpg') }}" class="rounded-circle" alt="User Image"></a>
        <div class="content-profile">
            @if (session('my_app__current_member'))
                <h4 class="media-heading">{{UserHelper::getClubName(session('my_app__current_member')['club_id'])}}</h4>
            @endif
            <h4 class="media-heading">
                @if (Auth::check())
                    {{auth()->user()->first_name}} {{auth()->user()->last_name}}
                @endif
            </h4>
            <ul class="icon-list">
                <li>
                    <a href="{{route('home')}}" title="user">
                        <i class="fa fa-fw ti-user"></i>
                    </a>
                </li>
                <li>
                    <a href="#" title="settings">
                        <i class="fa fa-fw ti-settings"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
