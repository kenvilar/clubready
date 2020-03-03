@extends('layouts.app')

@section('content')

    <users-create-and-edit-view-vue :model_id="{{isset($user->id) ? $user->id : 0}}"/>

@endsection
