@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1 class="m-0 text-dark">Profile</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                    <a href="{{ route('admin.edit-profile') }}" class="btn btn-primary">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Edit
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive mt-4">
                    <table class="table table-hover table-striped">
                        <tr>
                            <th>Username</th>
                            <td>{{ $user->username ?? '-' }}</td>
                        </tr>

                        <tr>
                            {{-- email --}}
                            <th>Email</th>
                            <td>{{ $user->email ?? '-' }}</td>
                        </tr>

                        <tr>
                            {{-- nama --}}
                            <th>Nama</th>
                            <td>{{ $librarian->librarian_name ?? '-' }}</td>
                        </tr>

                        <tr>
                            {{-- position --}}
                            <th>Jabatan</th>
                            <td>{{ $librarian->position ?? '-' }}</td>
                        </tr>

                        <tr>
                            {{-- phone --}}
                            <th>Telepon</th>
                            <td>{{ $librarian->phone_number ?? '-' }}</td>
                        </tr>

                        <tr>
                            {{-- address --}}
                            <th>Alamat</th>
                            <td>{{ $librarian->address ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
