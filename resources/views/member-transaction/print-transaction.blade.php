@extends('adminlte::page')

@section('title', 'Histori Transaksi')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <x-rtransaction :borrowTransaction="$borrowTransaction" />
@stop
