@extends('layouts.app')

@push('stylesheets')
    <link href="{{ asset('css/custom_css/invoice.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('breadcrumb')
    <h1>Invoice</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/home">
                <i class="fa fa-fw ti-home"></i> Dashboard
            </a>
        </li>
        <li> Extra Pages</li>
        <li class="active">
            Invoice
        </li>
    </ol>
@endsection

@section('content')
    {{--<users-current-user-info-vue>--}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa fa-fw ti-credit-card"></i> My Profile
            </h3>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-condensed" id="customtable">
                        <tbody>
                        <tr>
                            <td>
                                Samsung Galaxy Grand
                            </td>
                            <td>
                                $700
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Samsung Galaxy Grand
                            </td>
                            <td>
                                $700
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script src="{{ asset('js/custom_js/invoice.js') }}" type="text/javascript"></script>
@endpush
