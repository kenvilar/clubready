<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ \App\Models\Setting::query()->first()->site_name ??  config('app.name', '::Admin Login::') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- end of bootstrap -->

    <!--page level css -->
    <link href="{{ asset('css/themify-icons/css/themify-icons.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <!--end page level css-->
</head>

<body id="sign-in">

<div id="app">
    <div class="preloader">
        <div class="loader_img"><img src="{{ asset('img/loader.gif') }}" alt="loading..." height="64" width="64"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-10 col-sm-8 m-auto login-form">

                <h2 class="text-center logo_h2">
                    <img src="{{ asset('img/logo/logo-black-text.png') }}" alt="Logo" width="200">
                </h2>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.Laravel = {!! json_encode(['apiToken' => session('myToken') ?? null]) !!};
</script>

<!-- global js -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- end of global js -->

<!-- page level js -->
<script src="{{ asset('vendors/iCheck/js/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
@stack('footer-scripts')
<!-- end of page level js -->
</body>

</html>

