@extends('layouts.app')

@push('stylesheets')
    <link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/form_layouts.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')
    <h1>Memberships</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li><a href="{{route('web.membership.index')}}">Show List</a></li>
        @if (isset($membership->id))
            <li><a href="{{route('web.membership.show', $membership->id)}}">Show Item</a></li>
        @endif
        <li class="active">@if (isset($membership->id)) Edit @else Create @endif Item</li>
    </ol>
@endsection

@section('content')
    <memberships-create-and-edit-view-vue :model_id="{{isset($membership->id) ? $membership->id : 0}}"/>
@endsection

@push('footer-scripts')
    <script src="{{asset('vendors/iCheck/js/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
@endpush
