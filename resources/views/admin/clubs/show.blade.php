@extends('layouts.app')

@push('stylesheets')
    <link href="{{ asset('css/custom_css/invoice.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('breadcrumb')
    <h1>Clubs</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li><a href="{{route('web.club.index')}}">Show List</a></li>
        <li class="active">Show Item</li>
    </ol>
@endsection

@section('content')
    <clubs-detail-view-vue :model_id="{{isset($club->id) ? $club->id : 0}}"/>
@endsection

@push('footer-scripts')
    <script src="{{ asset('js/custom_js/invoice.js') }}" type="text/javascript"></script>
@endpush
