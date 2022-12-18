@extends('adminlte::page')

@section('title', 'Dashboard Super Admin')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $jumlahUser }}</h3>
                    <p>Akun User</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('members.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $jumlahLibrarian }}</h3>
                    <p>Petugas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('members.index') }}" class="small-box-footer">More info <i class="fas fa-"></i></a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $jumlahMember }}</h3>
                    <p>Member</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.transaction-list') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $jumlahTransaksiPeminjamanSukses }}</h3>
                    <p>Peminjaman Sukses</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <a href="{{ route('admin.transaction-list') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-md-6 text-center">
                            <img src="{{ asset('assets/images/code_thinking.svg') }}" width="110%" alt="Reading Book">
                        </div>
                        <div class="col-md-5 align-self-sm-center">
                            <h3 class="text-center">Hallo {{ Auth::user()->username }} 👋</h3>
                            <p class="text-center">
                                Lihat activity log terbaru klik tombol dibawah ini
                            </p>
                            <div class="text-center">
                                <a href="{{ route('superadmin.activity-log') }}"
                                    class="btn btn-outline-success btn-pinjam">
                                    <i class="fas fa-chart-line"></i>
                                    Lihat Activity Log Terbaru
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
