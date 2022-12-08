@extends('adminlte::page')

@section('title', 'Detail Study Program')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Study Program</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('study-programs.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                    <a href="{{ route('study-programs.edit', $study_program->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-pen" aria-hidden="true"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive mt-4">
                        <table class="table table-hover table-striped">
                            <tr>
                                <th> Program Studi </th>
                                <td> {{ $study_program->study_name }} </td>
                            </tr>
                            <tr>
                                <th> Fakultas </th>
                                <td> {{ $study_program->faculty->faculty_name }} </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
