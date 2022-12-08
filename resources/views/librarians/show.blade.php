@extends('adminlte::page')

@section('title', 'Detail Petugas')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Petugas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('librarians.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                    <a href="{{ route('librarians.edit', $librarian->id) }}" class="btn btn-outline-primary">
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
                                <th>Nama Petugas</th>
                                <td>{{ $librarian->librarian_name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $librarian->position }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $librarian->address }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $librarian->gender }}</td>
                            </tr>
                            <tr>
                                <th>No. Telepon</th>
                                <td>{{ $librarian->phone_number }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
