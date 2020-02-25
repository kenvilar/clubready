@extends('layouts.app')

@section('content')

    This is clubs index page

    <div id="list-and-detail-club-vue">
        <list-and-detail-club-vue></list-and-detail-club-vue>
    </div>

@endsection

@push('footer-scripts')
    <script>
        var formClubVue = new Vue({
            el: '#list-and-detail-club-vue',
        });
    </script>
@endpush
