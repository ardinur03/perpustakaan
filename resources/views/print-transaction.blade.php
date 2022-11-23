@extends('adminlte::page')

@section('title', 'Histori Transaksi')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <div class="invoice p-3 mb-3">

        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Laporan Transaksi
                    <small class="float-right">Date: 2/10/2022</small>
                </h4>
            </div>

        </div>

        <div class="row invoice-info">
            <div class="col-6">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:50%">Nama:</th>
                                <td>Achmadya Ridwan Ilyawan</td>
                            </tr>
                            <tr>
                                <th>Kode Transaksi</th>
                                <td>TRX-0001</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Buku</th>
                            <th>Kode Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Belajar Laravel</td>
                            <td>BLR-0001</td>
                            <td>2020-01-01</td>
                            <td>2020-01-10</td>
                            <td><span class="badge badge-primary">Dipinjam</span></td>
                            <td>Rp. 0</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Matematika Diskrit</td>
                            <td>BLR-0001</td>
                            <td>2020-01-01</td>
                            <td>2020-01-10</td>
                            <td><span class="badge badge-danger">Belum Dikembalikan</span></td>
                            <td>Rp. 500</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Struktur Data</td>
                            <td>BLR-0001</td>
                            <td>2020-01-01</td>
                            <td>2020-01-10</td>
                            <td><span class="badge badge-success">Dikembalikan</span></td>
                            <td>Rp. 0</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <div class="row no-print">
            <div class="col-12">
                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Print Transaksi
                </button>
            </div>
        </div>
    </div>
@stop
