@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h6>You cannot access this page! This is for only '{{$role}}'.</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
