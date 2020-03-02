@extends('layouts.app')

@section('content')

    <vehicles-detail-view-vue :model_id="{{isset($vehicle->id) ? $vehicle->id : 0}}"/>

@endsection
