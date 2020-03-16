<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ClubReady') }}</title>

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- global css -->
    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('css/app2.css') }}" type="text/css" rel="stylesheet"/>
    <!-- end of global css -->

    <!--page level css -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">
    <!--end of page level css-->

    @stack('stylesheets')
</head>
<body class="skin-default">

@include('inc.parts.preloader.preloader')

@include('inc.parts.header.header')

<div id="app" class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar">
            <div id="menu" role="navigation">

                @include('inc.parts.left-sidebar.profile')

                @include('inc.parts.left-sidebar.navbar-left')

            </div>
        </section>
    </aside>
    <aside class="right-side">

        <section class="content-header">

            @yield('breadcrumb')

        </section>

        @yield('content')

    </aside>
</div>

<div id="qn"></div>

<!-- global js -->
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app2.js') }}" type="text/javascript"></script>
<!-- end of global js -->

<!-- begining of page level js -->
@stack('footer-scripts')
<!-- end of page level js -->

</body>

</html>
