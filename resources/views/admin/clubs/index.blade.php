@extends('layouts.app')

@section('content')

    <div id="list-club-vue">
        <list-club-vue></list-club-vue>
    </div>

@endsection

@push('footer-scripts')
    <script>
        var listClubVue = new Vue({
            el: '#list-club-vue',
        });
    </script>
@endpush
