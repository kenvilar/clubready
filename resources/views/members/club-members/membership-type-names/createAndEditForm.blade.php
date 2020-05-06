@extends('layouts.app')

@push('stylesheets')
    <link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/form_layouts.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')
    <h1>Membership Type Names</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li><a href="{{route('web.club-member.membership-type-names.index', $clubMember->uuid)}}">Show List</a></li>
        @if (isset($clubMember->uuid) && isset($membershipTypeName->id))
            <li><a href="{{route('web.club-member.membership-type-names.show', $clubMember->uuid, $membershipTypeName->id)}}">
                    Show Item</a></li>
        @endif
        <li class="active">@if (isset($clubMember->uuid)) Edit @else Create @endif Item</li>
    </ol>
@endsection

@section('content')
    This is the club-members.membership-type-names create and edit page
@endsection

@push('footer-scripts')
    <script src="{{asset('vendors/iCheck/js/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
@endpush
