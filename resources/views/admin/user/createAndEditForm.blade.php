@extends('layouts.app')

@section('content')

    <users-create-and-edit-view-vue :model_id="'{{isset($user->member_number) ? $user->member_number : ''}}'"/>

@endsection
