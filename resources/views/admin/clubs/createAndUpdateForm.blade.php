@extends('layouts.app')

@section('content')

    This is clubs create page

    <div id="create-and-edit-club-vue">
        <create-and-edit-club-vue :club_id="{{isset($club->id) ? $club->id : 0}}"></create-and-edit-club-vue>
    </div>

@endsection

@push('footer-scripts')
    <script>
        var formClubVue = new Vue({
            el: '#create-and-edit-club-vue',
        });
    </script>
@endpush
