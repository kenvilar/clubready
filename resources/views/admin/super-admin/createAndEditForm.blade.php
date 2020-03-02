@extends('layouts.app')

@section('content')

    <super-admins-create-and-edit-view-vue :model_id="{{isset($superAdmin->id) ? $superAdmin->id : 0}}"/>

@endsection
