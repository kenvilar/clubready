@extends('layouts.app')

@section('content')

    <users-detail-view-vue :model_id="'{{isset($user->member_number) ? $user->member_number : ''}}'"/>

@endsection
