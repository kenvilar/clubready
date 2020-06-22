@extends('layouts.app')

@push('stylesheets')
    <link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/form_layouts.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')
    <h1>Edit Club</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li><a href="{{route('web.club-member.clubs.show', [$clubMember->uuid, $club->uuid])}}">Club Details</a></li>
        <li class="active">@if (isset($clubMember->uuid)) Edit @endif Club</li>
    </ol>
@endsection

@section('content')
    <club-members--clubs-create-and-edit-view-vue/>
@endsection
