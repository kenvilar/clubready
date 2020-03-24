@extends('layouts.app')

@push('stylesheets')
    <link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/form_layouts.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')
    <h1>Users</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li><a href="{{route('web.user.index')}}">Show List</a></li>
        @if (isset($user->member_number))
            <li><a href="{{route('web.user.show', $user->member_number)}}">Show User</a></li>
        @endif
        <li class="active">@if (isset($user->member_number)) Edit @else Create @endif User</li>
    </ol>
@endsection

@section('content')
    <users-create-and-edit-view-vue :model_id="'{{isset($user->member_number) ? $user->member_number : ''}}'"/>
@endsection

@push('footer-scripts')
    <script src="{{asset('vendors/iCheck/js/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
@endpush
