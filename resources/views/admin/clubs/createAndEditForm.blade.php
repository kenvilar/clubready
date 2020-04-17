@extends('layouts.app')

@push('stylesheets')
    <link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/form_layouts.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')
    <h1>Clubs</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li><a href="{{route('web.club.index')}}">Show List</a></li>
        @if (isset($club->id))
            <li><a href="{{route('web.club.show', $club->id)}}">Show Item</a></li>
        @endif
        <li class="active">@if (isset($club->id)) Edit @else Create @endif Item</li>
    </ol>
@endsection

@section('content')
    <clubs-create-and-edit-view-vue :model_id="{{isset($club->id) ? $club->id : 0}}"/>
@endsection

@push('footer-scripts')
    <script src="{{asset('vendors/iCheck/js/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
@endpush
