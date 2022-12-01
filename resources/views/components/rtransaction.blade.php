<div>
    <div class="invoice p-3 mb-3">
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe mr-2"></i> Cetak Transaksi
                    {{-- date now from device --}}
                    <small class="float-right">Date: {{ date('d M Y H:i:s') }}</small>
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
                            @php
                                if ($borrowTransaction->status == 'overdue') {
                                    $text = 'danger';
                                } elseif ($borrowTransaction->status == 'borrowed') {
                                    $text = 'primary';
                                } else {
                                    $text = 'success';
                                }
                            @endphp
                            <td><span class="badge badge-{{ $text }}">{{ $borrowTransaction->status }}</span>
                            </td>
                            <td>{{ $borrowTransaction->fine == 0 ? 'Tidak Ada' : $borrowTransaction->fine }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">

                <form action="{{ route('member.borrow-transaction-print') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $borrowTransaction->id }}">
                    <button type="submit" class="btn btn-outline-danger float-right"><i class="fas fa-download"></i>
                        Generate
                        PDF
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
