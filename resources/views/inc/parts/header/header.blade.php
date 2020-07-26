<!-- header logo: style can be found in header-->
<header class="header">
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="{{ route('home') }}" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the marginin -->
            <img
                src="{{ \App\Models\Setting::query()->first()->logo ?
                        '../storage/' . \App\Models\Setting::query()->first()->logo :
                        asset('img/logo/logo-white-text.png') }}" alt="logo" width="80"/>
        </a>
        <!-- Header Navbar: style can be found in header-->
        <!-- Sidebar toggle button-->
        <div class="mr-auto">
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i
                    class="fa fa-fw ti-menu"></i>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                {{--@include('inc.parts.navbar-right.messages')--}}
                <!--rightside toggle-->
                {{--@include('inc.parts.navbar-right.users')--}}
                <!-- User Account: style can be found in dropdown-->
                @include('inc.parts.navbar-right.user-account')
            </ul>
        </div>
    </nav>
</header>
