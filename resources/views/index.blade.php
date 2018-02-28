@extends('layout')

@section('title', 'Check the exchange rate on your last birthday!')

@section('content')
    {{ Form::open(['files' => true]) }}
        {{ Form::date('birthday', $date) }}
        {{ Form::submit() }}
    {{ Form::close() }}
@endsection
