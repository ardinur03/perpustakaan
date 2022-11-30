<div>
    <div class="invoice p-3 mb-3" style="background-color: red">
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe mr-2"></i> Cetak Transaksi
                    <small class="float-right">{{ now('Y m d') }}</small>
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
                                <td>{{ $borrowTransaction->user->member->member_name }}</td>
                            </tr>
                            <tr>
                                <th>Kode Transaksi</th>
                                <td>{{ $borrowTransaction->transaction_code }}</td>
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
                            <th>Nama Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $borrowTransaction->book->book_name }}</td>
                            <td>{{ $borrowTransaction->borrow_date }}</td>
                            <td>{{ $borrowTransaction->return_date }}</td>
                            <td><span
                                    class="badge badge-{{ $borrowTransaction->status == 'overdue' ? 'danger' : 'success' }}">{{ $borrowTransaction->status }}</span>
                            </td>
                            <td>{{ $borrowTransaction->fine == 0 ? 'Tidak Ada' : $borrowTransaction->fine }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="{{ route('member.borrow-transaction-print') }}" class="btn btn-outline-danger float-right"
                    style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Print Transaksi
                </a>
            </div>
        </div>
    </div>
</div>
