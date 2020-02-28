@extends('layouts.app')

@section('content')

    <membership-type-names-create-and-edit-view-vue
        :model_id="{{isset($membershipTypeName->id) ? $membershipTypeName->id : 0}}"/>

@endsection
