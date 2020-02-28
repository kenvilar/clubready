@extends('layouts.app')

@section('content')

    <membership-types-detail-view-vue :model_id="{{isset($membershipType->id) ? $membershipType->id : 0}}"/>

@endsection
