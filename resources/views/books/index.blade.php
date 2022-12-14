@extends('adminlte::page')

@section('title', 'List Books')

@section('content_header')
    <h1 class="m-0 text-dark">List Books</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('books.create') }}" class="btn btn-success mb-2">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </a>
                    <div class="table-responsive">

                        <table class="table table-hover table-striped yajra-datatables w-100" id="books">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul Buku</th>
                                    <th>Penerbit</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#5C636A',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                console.log(result);
                if (result.dismiss != 'cancel' && result) {
                    $('#delete-form').attr('action', $(el).attr('href'));
                    $('#delete-form').submit();
                }
            })
        }

        var table = $('#books').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('books.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'book_name',
                    name: 'book_name'
                },
                {
                    data: 'publisher',
                    name: 'publisher'
                },
                {
                    data: 'category.category_name',
                    name: 'category.category_name'
                },
                {
                    data: 'stock',
                    name: 'stock'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true
                },
            ]
        });

        table.on('draw.dt', function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
