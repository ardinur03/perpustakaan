@extends('adminlte::page')

@section('title', 'Transaction List')

@section('content_header')
    <h1 class="m-0 text-dark">Transaction List</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $totalMember }}</h3>
                    <p>Member</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('members.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalBuku }}</h3>
                    <p>Buku</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="{{ route('members.index') }}" class="small-box-footer">More info <i class="fas fa-"></i></a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalBorrowTransactionReturn }}</h3>
                    <p>Peminjaman Kembali</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <a href="{{ route('admin.transaction-list') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalBorrowTransactionOverdue }}</h3>
                    <p>Peminjaman Terlambat</p>
                </div>
                <div class="icon">
                    <i class="fas fa-coins"></i>
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
                            <img src="{{ asset('assets/images/dashboard.svg') }}" width="110%" alt="Reading Book">
                        </div>
                        <div class="col-md-5 align-self-sm-center">
                            <h3 class="text-center">Hallo {{ Auth::user()->librarian->librarian_name }} 👋</h3>
                            <p class="text-center">
                                Lihat daftar transaksi peminjaman member dan lakukan pengecekkan buku yang dipinjam
                            </p>
                            <div class="text-center">
                                <a href="{{ route('admin.transaction-list') }}" class="btn btn-outline-success btn-pinjam">
                                    <i class="fas fa-book mr-2"></i>
                                    Lihat Transaksi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
