@extends('adminlte::page')

@section('title', 'Tambah Fakultas')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Fakultas</h1>
@stop

@section('content')
    <form action="{{ route('faculties.store') }}" method="post">
        @csrf
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input_faculty">Fakultas</label>
                            <input type="text" class="form-control @error('faculty_name') is-invalid @enderror"
                                id="input_faculty" placeholder="Fakultas" name="faculty_name"
                                value="{{ old('faculty_name') }}">
                            @error('faculty_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_category">Study Program</label>
                            <select name="study_program_id" id="input_category"
                                class="form-control @error('study_program_id') is-invalid @enderror">
                                <option value="">Pilih Study Program</option>
                                @foreach ($study_programs as $study_program)
                                    <option value="{{ $study_program->id }}"
                                        {{ old('study_program_id') == $study_program->id ? 'selected' : '' }}>
                                        {{ $study_program->study_name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('faculties.index') }}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @stop
