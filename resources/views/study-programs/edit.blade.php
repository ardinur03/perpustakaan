@extends('adminlte::page')

@section('title', 'Edit Study Programs')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Study Programs</h1>
@stop

@section('content')
    <form action="{{ route('study-programs.update', $study_program) }}" method="post">
        @method('PUT')
        @csrf
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <input type="text" class="form-control @error('study_name') is-invalid @enderror"
                                id="exampleInputName" placeholder="Study Name" name="study_name"
                                value="{{ $study_program->study_name ?? old('study_name') }}">
                            @error('study_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('study-programs.index') }}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @stop
