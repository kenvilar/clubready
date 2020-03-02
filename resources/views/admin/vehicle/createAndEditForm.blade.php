@extends('layouts.app')

@section('content')

    <vehicles-create-and-edit-view-vue :model_id="{{isset($vehicle->id) ? $vehicle->id : 0}}"/>

@endsection
