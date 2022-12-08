@extends('adminlte::page')

@section('title', 'Detail Facultas')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Facultas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('faculties.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                    <a href="{{ route('faculties.edit', $faculty->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-pen" aria-hidden="true"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive mt-4">
                        <table class="table table-hover table-striped">
                            @foreach ($study_programs as $study_program)
                                @if ($faculty->study_program_id == $study_program->id)
                                    <tr>
                                        <th>Fakultas</th>
                                        <td>{{ $faculty->faculty_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td>{{ $faculty->studyProgram->study_name }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
