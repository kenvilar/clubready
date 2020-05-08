@extends('layouts.auth')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h6>
                                PLEASE CHOOSE A CLUB!!
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('footer-scripts')
    <script src="{{ asset('js/custom_js/login.js') }}" type="text/javascript"></script>
@endpush
