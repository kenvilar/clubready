@extends('layouts.app')

@push('stylesheets')
    <link href="{{ asset('css/custom_css/invoice.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('breadcrumb')
    <h1>Super Admins</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li><a href="{{route('web.super-admin.index')}}">Show List</a></li>
        <li class="active">Show Item</li>
    </ol>
@endsection

@section('content')
    <super-admins-detail-view-vue :model_id="{{isset($superAdmin->id) ? $superAdmin->id : 0}}"/>
@endsection

@push('footer-scripts')
    <script src="{{ asset('js/custom_js/invoice.js') }}" type="text/javascript"></script>
@endpush
