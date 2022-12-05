@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-rtransaction :borrowTransaction="$borrowTransaction" :isShow="$isShow" />
@stop
