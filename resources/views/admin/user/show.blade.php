@extends('layouts.app')

@push('stylesheets')
    <link href="{{ asset('css/custom_css/invoice.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('breadcrumb')
    <h1>User Info</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li><a href="{{route('web.user.index')}}">Users List</a></li>
        <li class="active">{{$user->first_name}} {{$user->last_name}}</li>
    </ol>
@endsection

@section('content')
    <users-detail-view-vue :model_id="'{{isset($user->member_number) ? $user->member_number : ''}}'"/>
@endsection

@push('footer-scripts')
    <script src="{{ asset('js/custom_js/invoice.js') }}" type="text/javascript"></script>
@endpush
