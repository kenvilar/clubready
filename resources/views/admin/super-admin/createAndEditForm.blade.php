@extends('layouts.app')

@push('stylesheets')
    <link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/form_layouts.css')}}" rel="stylesheet" type="text/css"/>

    <!--select2-->
    <link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendors/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('breadcrumb')
    <h1>Super Admins</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li><a href="{{route('web.super-admin.index')}}">Show List</a></li>
        @if (isset($superAdmin->id))
            <li><a href="{{route('web.super-admin.show', $superAdmin->id)}}">Show Item</a></li>
        @endif
        <li class="active">@if (isset($superAdmin->id)) Edit @else Create @endif Item</li>
    </ol>
@endsection

@section('content')
    <super-admins-create-and-edit-view-vue :model_id="{{isset($superAdmin->id) ? $superAdmin->id : 0}}"/>
@endsection

@push('footer-scripts')
    <script src="{{asset('vendors/iCheck/js/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
@endpush
