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
    <link href="{{ asset('vendors/swiper/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/nvd3/css/nv.d3.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/lc_switch.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/custom_css/dashboard1.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/custom_css/dashboard1_timeline.css') }}" rel="stylesheet"/>
    <!--end of page level css-->
</head>
<body class="skin-default">

@include('inc.parts.preloader.preloader')

@include('inc.parts.header.header')

<div id="app" class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            <div id="menu" role="navigation">
                @include('inc.parts.left-sidebar.profile')
                @include('inc.parts.left-sidebar.navbar-left')
            </div><!-- menu -->
        </section><!-- /.sidebar -->
    </aside>
    <aside class="right-side">

        <section class="content-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-5 col-8">
                    <div class="header-element">
                        <h3>ClubReady/
                            <small>Dashboard</small>
                        </h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xl-12 col-12">
                    <div class="row">
                        <div class="col-sm-12">
                            {{--content here--}}
                        </div>
                    </div>
                </div>
            </div>

            <!--rightside bar -->
            {{--@include('inc.parts.right-sidebar.rightsidebar-right-content')--}}
            <!-- /#right -->
            <div class="background-overlay"></div>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<div id="qn"></div>

<!-- global js -->
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app2.js') }}" type="text/javascript"></script>
<!-- end of global js -->

<!-- begining of page level js -->
<!--Sparkline Chart-->
<script src="{{ asset('js/custom_js/sparkline/jquery.flot.spline.js') }}" type="text/javascript"></script>
<!-- flip --->
<script src="{{ asset('js/flip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/lc_switch.min.js') }}" type="text/javascript"></script>
<!--flot chart-->
<script src="{{ asset('js/flot/js/jquery.flot.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/flot/js/jquery.flot.resize.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/flot/js/jquery.flot.stack.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/flot/js/jquery.flot.spline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/flot/js/jquery.flot.tooltip.js') }}" type="text/javascript"></script>
<!--swiper-->
<script src="{{ asset('vendors/swiper/js/swiper.min.js') }}" type="text/javascript"></script>
<!--chartjs-->
{{--<script src="{{ asset('vendors/chartjs/js/Chart.js') }}"></script>--}}
<!--nvd3 chart-->
<script src="{{ asset('js/nvd3/d3.v3.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/nvd3/js/nv.d3.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/newsTicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dashboard1.js') }}" type="text/javascript"></script>
<!-- end of page level js -->

@stack('footer-scripts')

</body>

</html>
