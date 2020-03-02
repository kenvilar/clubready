@extends('layouts.app')

@section('content')

    <super-admins-detail-view-vue :model_id="{{isset($superAdmin->id) ? $superAdmin->id : 0}}"/>

@endsection
