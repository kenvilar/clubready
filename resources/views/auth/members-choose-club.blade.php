@extends('layouts.app')

@section('content')

    <section class="content mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h6>PLEASE CHOOSE A CLUB!!</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('footer-scripts')
    <script>
        $("img[alt='Logo'], .left-side, .right-side .content-header, " +
            ".user.user-menu li:nth-child(2), .user.user-menu li:nth-child(4), .navbar-btn.sidebar-toggle").hide();
        $(".right-side").css({"margin-left": 0});
    </script>
@endpush
