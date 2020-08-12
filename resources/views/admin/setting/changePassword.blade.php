@extends('layouts.app')

@push('stylesheets')
    <!--file input-->
    <link href="{{ asset('css/passtrength/passtrength.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('breadcrumb')
    <h1>Settings</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a>
        </li>
        <li class="active">Edit Settings</li>
    </ol>
@endsection

@section('content')
    <settings-change-password-view-vue></settings-change-password-view-vue>
@endsection

@push('footer-scripts')
    <script src="{{ asset('js/passtrength/passtrength.js') }}"></script>
    <script>
        "use strict";
        $(document).ready(function () {
            $('#password1').passtrength({
                minChars: 5,
                passwordToggle: true,
                tooltip: true
            });
        });
    </script>
@endpush
