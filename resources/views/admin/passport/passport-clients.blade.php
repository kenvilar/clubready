@extends('layouts.app')

@section('breadcrumb')
    <h1>Laravel Passport</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a></li>
        <li class="active">Passport Clients</li>
    </ol>
@endsection

@section('content')
    <passport-clients></passport-clients>
@endsection

