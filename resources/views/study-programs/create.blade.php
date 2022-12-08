@extends('adminlte::page')

@section('title', 'Tambah Study Programs')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Study Programs</h1>
@stop

@section('content')
    <form action="{{ route('study-programs.store') }}" method="post">
        @csrf
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="study_name">Study Name</label>
                            <input type="text" class="form-control @error('study_name') is-invalid @enderror"
                                id="exampleInputName" placeholder="Study Name" name="study_name"
                                value="{{ old('study_name') }}">
                            @error('study_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save mr-1" aria-hidden="true"></i>
                            Simpan
                        </button>
                        <a href="{{ route('study-programs.index') }}" class="btn btn-outline-secondary">
                            <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @stop
