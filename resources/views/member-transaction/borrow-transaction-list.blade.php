@extends('adminlte::page')

@section('title', 'Borrow Transaction List')

@section('content_header')
    <h1 class="m-0 text-dark">Borrow Transaction List</h1>
@stop

@section('content')
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($isBorrowed)
                        <a href="{{route('member.borrow-transaction-return')}}" class="btn btn-danger mb-3">
                            <i class="fas fa-upload"></i> <span class="ml-2">Pengembalian</span>
                        </a>
                    @endif

                    <table class="table table-hover table-striped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($borrowTransactions as $key => $borrowTransaction)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$borrowTransaction->book->book_name}}</td>
                                <td>{{$borrowTransaction->borrow_date}}</td>
                                <td>{{$borrowTransaction->return_date}}</td>
                                <td>
                                    @if($borrowTransaction->status == 'borrowed')
                                        <span class="badge badge-primary">{{$borrowTransaction->status}}</span>
                                    @elseif($borrowTransaction->status == 'returned')
                                        <span class="badge badge-success">{{$borrowTransaction->status}}</span>
                                    @elseif($borrowTransaction->status == 'overdue')
                                        <span class="badge badge-danger">{{$borrowTransaction->status}}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('member.borrow-transaction-show', $borrowTransaction)}}" class="btn btn-sm text-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });
    </script>
@endpush