@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $countAllBorrowTransaction }}</h3>
                    <p>Transaksi Peminjaman</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $countAllBorrowTransactionReturned }}</h3>
                    <p>Dikembalikan Tepat Waktu</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $countAllBorrowTransactionOverdue }}</h3>
                    <p>Status Peminjaman Terlambat</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $countAllBorrowTransactionFineNow }}</h3>
                    <p>Total Denda</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">

                        <div class="col-md-6 text-center">
                            @if ($countAllBorrowTransactionBorrowed == 0)
                                <img src="{{ asset('assets/images/free.svg') }}" width="110%" alt="Reading Book">
                            @else
                                <img src="{{ asset('assets/images/reading_time.svg') }}" width="120%" alt="Reading Book">
                            @endif

                        </div>
                        <div class="col-md-5 align-self-sm-center">
                            {{-- jika member belum meminjam buku maka tampilkan ajakan untuk membaca buku --}}
                            @if ($countAllBorrowTransactionBorrowed == 0)
                                <h3 class="text-center">Ayo Pinjam Buku & Mulai Membaca</h3>
                                <p class="text-center">Kamu belum meminjam buku, ayo pinjam buku sekarang juga</p>
                                <div class="text-center">
                                    <a href="{{ route('member.peminjaman-buku') }}"
                                        class="btn btn-outline-success btn-pinjam">
                                        <i class="fas fa-book mr-2"></i>
                                        Pinjam Buku
                                    </a>
                                </div>
                            @else
                                <h3 class="text-center">Hallo 👋, Selamat Membaca!</h3>
                                <p class="text-center">Saat ini kamu sedang meminjam buku dengan deadline pengembalian
                                    <b>{{ date('d F Y', strtotime($borrowTransactionNow->return_date)) }}</b>
                                    jangan sampai terlambat ya 🙌
                                </p>
                                <div class="text-center">
                                    <a href="{{ route('member.borrow-transaction-list') }}"
                                        class="btn btn-outline-success btn-pinjam">Lihat Peminjaman</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
