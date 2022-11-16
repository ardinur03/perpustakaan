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

                    <table class="table table-hover table-striped" id="example2">
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
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($books as $key => $book)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $book->book_name }}</td>
                                    <td>{{ $book->publisher }}</td>
                                    <td>{{ $book->category->category_name }}</td>
                                    <td>{{ $book->stock }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn text-primary btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('books.destroy', $book->id) }}"
                                            onclick="notificationBeforeDelete(event, this)" class="btn text-danger btn-sm">
                                            <i class="fas fa-trash" aria-hidden="true"></i>
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
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }
    </script>
@endpush
