@extends('layouts.app')

@section('content')

    <club-members-create-and-edit-view-vue :model_id="{{isset($clubMember->id) ? $clubMember->id : 0}}"/>

@endsection
