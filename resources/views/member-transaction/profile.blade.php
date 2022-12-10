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
                    <a href="{{ route('member.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                    <a href="{{ route('member.edit-profile') }}" class="btn btn-primary">
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
                            <th>Member Code</th>
                            <td>{{ $member->member_code }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>

                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ $member->member_name }}</td>
                        </tr>

                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $member->gender }}</td>
                        </tr>

                        <tr>
                            <th>Alamat</th>
                            <td>{{ $member->address }}</td>
                        </tr>

                        <tr>
                            <th>No. Telepon</th>
                            <td>{{ $member->phone_number }}</td>
                        </tr>

                        <tr>
                            <th>Program Studi</th>
                            <td>{{ $member->study_program->study_name ?? '' }}</td>
                        </tr>

                        <tr>
                            <th>Tanggal Bergabung</th>
                            <td>{{ $member->created_at->format('d F Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
