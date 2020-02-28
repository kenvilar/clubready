@extends('layouts.app')

@section('content')

    <inductions-create-and-edit-view-vue :model_id="{{isset($induction->id) ? $induction->id : 0}}"/>

@endsection
