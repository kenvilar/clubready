@extends('layouts.app')

@section('content')

    This is clubs create page

    <div id="form-club-vue">
        <form-club-vue></form-club-vue>
    </div>

@endsection

@push('footer-scripts')
    <script>
        var formClubVue = new Vue({
            el: '#form-club-vue',
        });
    </script>
@endpush
