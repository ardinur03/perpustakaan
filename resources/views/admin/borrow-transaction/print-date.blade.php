@extends('adminlte::page')

@section('title', 'Print Laporan Transaksi')

@section('content_header')
    <h1 class="m-0 text-dark">Print Laporan Transaksi</h1>
@stop

@section('content')
    <form action="{{ route('admin.transaction-between-date-print') }}" method="post">
        @method('POST')
        @csrf
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        {{-- request start date --}}
                        <div class="form-group">
                            <label for="start_date">Waktu Awal</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- request end date --}}
                        <div class="form-group">
                            <label for="end_date">Waktu Akhir</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-danger"><i class="fas fa-download mr-1"
                                aria-hidden="true"></i>Generate</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
