@extends('layouts.app')

@push('stylesheets')
    <link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/form_layouts.css')}}" rel="stylesheet" type="text/css"/>

    <!--datedropper-->
    <link href="{{asset('vendors/datedropper/datedropper.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('breadcrumb')
    <h1>Membership Types</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li><a href="{{route('web.club-member.membership-types.index', $clubMember->uuid)}}">Show List</a></li>
        @if (isset($clubMember->uuid) && isset($membershipType->id))
            <li><a href="{{route('web.club-member.membership-types.show', [$clubMember->uuid, $membershipType->id])}}">
                    Show Item</a></li>
        @endif
        <li class="active">@if (isset($clubMember->uuid)) Edit @else Create @endif Item</li>
    </ol>
@endsection

@section('content')
    <club-members--membership-types-create-and-edit-view-vue/>
@endsection

@push('footer-scripts')
    <script src="{{asset('vendors/iCheck/js/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
@endpush
