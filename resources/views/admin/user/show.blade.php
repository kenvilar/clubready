@extends('layouts.app')

@section('content')

    <users-detail-view-vue :model_id="{{isset($user->id) ? $user->id : 0}}"/>

@endsection
