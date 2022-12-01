<div class="">
    <h1>Transaksi Peminjaman</h1>
    <table class="meta">
        <tr>
            <th><span>Nama:</span></th>
            <td><span>{{ $borrowTransaction->user->member->member_name }}</span></td>
        </tr>
        <tr>
            <th><span>Kode Transaksi:</span></th>
            <td><span>{{ $borrowTransaction->transaction_code }}</span></td>
        </tr>
        <tr>
            <th><span class="content">Tanggal Cetak:</span></th>
            <td><span class="content">{{ date('d M Y H:i:s') }}</span></td>
        </tr>
    </table>
    <table class="inventory">
        <thead>
            <tr>
                <th><span class="content">Nama Buku</span></th>
                <th><span class="content">Tanggal Peminjaman</span></th>
                <th><span class="content">Tanggal Pengembalian</span></th>
                <th><span class="content">Status</span></th>
                <th><span class="content">Denda</span></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span class="content">{{ $borrowTransaction->book->book_name }}</span></td>
                <td><span class="content">{{ $borrowTransaction->borrow_date }}</span></td>
                <td><span class="content">{{ $borrowTransaction->return_date }}</span></td>
                <td><span
                        class="badge badge-{{ $borrowTransaction->status == 'overdue' ? 'danger' : 'success' }}">{{ $borrowTransaction->status }}</span>
                </td>
                <td><span
                        class="content">{{ $borrowTransaction->fine == 0 ? 'Tidak Ada' : $borrowTransaction->fine }}</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<style>
    * {
        border: 0;
        box-sizing: content-box;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
        font-style: inherit;
        font-weight: inherit;
        line-height: inherit;
        list-style: none;
        margin: 0;
        padding: 0;
        text-decoration: none;
        vertical-align: top;
    }

    /* heading */
    h1 {
        font: bold 100% sans-serif;
        letter-spacing: 0.5em;
        text-align: center;
        text-transform: uppercase;
    }

    /* table */
    table {
        font-size: 75%;
        table-layout: fixed;
        width: 100%;
        border-collapse: separate;
        border-spacing: 2px;
    }

    th,
    td {
        border-width: 1px;
        padding: 0.5em;
        position: relative;
        text-align: left;
    }

    th,
    td {
        border-radius: 0.25em;
        border-style: solid;
    }

    th {
        background: #EEE;
        border-color: #BBB;
    }

    td {
        border-color: #DDD;
    }

    body {
        box-sizing: border-box;
        height: 5in;
        margin: auto auto;
        overflow: hidden;
        padding: 0.5in;
        width: 8.5in;
        background: #FFF;
        border-radius: 1px;
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    }
</style>
