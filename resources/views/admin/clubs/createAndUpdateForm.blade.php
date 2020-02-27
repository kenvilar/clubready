@extends('layouts.app')

@section('content')

    This is clubs create page

    <div id="clubs-create-and-edit-view-vue">
        <clubs-create-and-edit-view-vue :club_id="{{isset($club->id) ? $club->id : 0}}"/>
    </div>

@endsection

@push('footer-scripts')
    {{-- --}}
@endpush
