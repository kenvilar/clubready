@extends('layouts.app')

@section('content')

    <membership-type-names-detail-view-vue
        :model_id="{{isset($membershipTypeName->id) ? $membershipTypeName->id : 0}}"/>

@endsection
