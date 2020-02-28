@extends('layouts.app')

@section('content')

    <clubs-detail-view-vue :model_id="{{isset($club->id) ? $club->id : 0}}"/>

@endsection

@push('footer-scripts')
    {{-- --}}
@endpush
