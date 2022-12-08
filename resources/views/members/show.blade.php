@extends('adminlte::page')

@section('title', 'Detail Member')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Member</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                    <a href="{{ route('members.edit', $member->id) }}" class="btn btn-outline-primary">
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
                                <th>Kode Member</th>
                                <td>{{ $member->member_code }}</td>
                            </tr>
                            <tr>
                                <th>Nama Member</th>
                                <td>{{ $member->member_name }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $member->address }}</td>
                            </tr>
                            <tr>
                                <th>No. Telepon</th>
                                <td>{{ $member->phone_number }}</td>
                            </tr>


                            @foreach ($faculties as $faculty)
                                @if ($faculty->id == $member->faculty_id)
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
