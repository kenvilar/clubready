@extends('layouts.app')

@push('stylesheets')
    <link href="{{asset('vendors/datatables/css/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/custom_css/responsive_datatables.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')
    <h1>Membership Types</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-fw ti-home"></i>Dashboard</a></li>
        <li class="active">Show List</li>
    </ol>
@endsection

@section('content')
    <membership-types-list-view-vue/>
@endsection

@push('footer-scripts')
    <script src="{{asset('vendors/datatables/js/jquery.dataTables.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendors/datatables/js/dataTables.bootstrap4.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/custom_js/responsive_datatables.js')}}" type="text/javascript"></script>
@endpush
