@extends('layouts.app')

@section('content')

    <div id="detail-club-vue">
        <detail-club-vue :club_id="{{isset($club->id) ? $club->id : 0}}"></detail-club-vue>
    </div>

@endsection

@push('footer-scripts')
    <script>
        var detailClubVue = new Vue({
            el: '#detail-club-vue',
        });
    </script>
@endpush
