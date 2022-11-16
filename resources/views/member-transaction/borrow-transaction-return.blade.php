@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Pengembalian</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
           <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">Judul     : {{ $borrowTransactions->book->book_name }}</h5>
                    <p class="card-text">Deskripsi : {{ $borrowTransactions->book->description }}</p>

                    <p class="card-title">Tanggal Pinjam : {{ $borrowTransactions->borrow_date }}</p>
                    <p class="card-text">Tanggal Kembali : {{ $borrowTransactions->return_date }}</p>

                    <a href="{{ route('member.borrow-transaction-return-store') }}" class="btn btn-danger" onclick="notificationBeforeDelete(event, this)">Kembalikan Buku</a>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <form action="" id="post-form" method="post">
        @csrf
    </form>
    <script>

        function notificationBeforeDelete(event, el) {
            event.preventDefault();

            Swal.fire({
                title: 'Apakah anda yakin ingin mengembalikan buku?',
                text: "Setelah dikembalikan, anda tidak bisa membatalkan pengembalian buku!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#DC3545',
                cancelButtonColor: '#97A1AA',
                confirmButtonText: 'Kembalikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.dismiss != 'cancel' && result) {
                    $("#post-form").attr('action', $(el).attr('href'));
                    $("#post-form").submit();
                }
            })
        }
    </script>
@endpush