@extends('layouts.app')

@push('stylesheets')
    <link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/form_layouts.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')
    <h1>Club Members</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li><a href="{{route('web.club-member.members.index', $clubMember->uuid)}}">Show List</a></li>
        @if (isset($clubMember->uuid) && isset($member->uuid))
            <li><a href="{{route('web.club-member.members.show', [$clubMember->uuid, $member->uuid])}}">
                    Show Item</a></li>
        @endif
        <li class="active">@if (isset($clubMember->uuid)) Edit @else Create @endif Item</li>
    </ol>
@endsection

@section('content')
    <club-members--members-create-and-edit-view-vue/>
@endsection
