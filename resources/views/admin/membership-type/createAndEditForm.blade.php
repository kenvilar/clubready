@extends('layouts.app')

@section('content')

    <membership-types-create-and-edit-view-vue :model_id="{{isset($membershipType->id) ? $membershipType->id : 0}}"/>

@endsection
