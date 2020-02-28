@extends('layouts.app')

@section('content')

    <memberships-create-and-edit-view-vue :model_id="{{isset($membership->id) ? $membership->id : 0}}"/>

@endsection
