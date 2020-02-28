@extends('layouts.app')

@section('content')

    <memberships-detail-view-vue :model_id="{{isset($membership->id) ? $membership->id : 0}}"/>

@endsection
