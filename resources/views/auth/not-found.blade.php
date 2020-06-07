@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 m-auto">
                <div class="text-center">

                    <div class="error_img">
                        <img src="{{ asset('img/pages/404.gif') }}" alt="404 error image">
                    </div>
                    <hr class="seperator">
                    <a href="/admin" class="btn btn-primary link-home">Go to dashboard page</a>
                </div>
            </div>
        </div>
    </section>

@endsection
