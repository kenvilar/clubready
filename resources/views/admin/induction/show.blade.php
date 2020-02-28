@extends('layouts.app')

@section('content')

    <inductions-detail-view-vue :model_id="{{isset($induction->id) ? $induction->id : 0}}"/>

@endsection
