@extends('layouts.app')

@push('stylesheets')
    <link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/form_layouts.css')}}" rel="stylesheet" type="text/css"/>

    <!--file input-->
    <link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/formelements.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('breadcrumb')
    <h1>Settings</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li class="active">Edit Settings</li>
    </ol>
@endsection

@section('content')
    <settings-edit-view-vue></settings-edit-view-vue>
@endsection

@push('footer-scripts')
    <script src="{{asset('vendors/iCheck/js/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>

    <!--file input-->
    <script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendors/bootstrap-fileinput/js/theme.js')}}" type="text/javascript"></script>
@endpush
