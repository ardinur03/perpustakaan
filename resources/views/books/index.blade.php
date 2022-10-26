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

                <a href="{{route('books.create')}}" class="btn btn-primary mb-2">
                    Tambah
                </a>

                <table class="table table-hover table-bordered table-stripped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul Buku</th>
                            <th>Jumlah Halaman</th>
                            <th>Deskripsi</th>
                            <th>Penerbit</th>
                            <th>Penulis</th>
                            <th>Stok</th>
                            <th>Genre</th>
                            <th>Tahun Rilis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $key => $book)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$book->book_name}}</td>
                            <td>{{$book->page}}</td>
                            <td>{{$book->description}}</td>
                            <td>{{$book->publisher}}</td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->stock}}</td>
                            <td>{{$book->category}}</td>
                            <td>{{date('Y', strtotime($book->published_year))}}</td>

                            <td>
                                <a href="{{route('books.edit', $book)}}" class="btn btn-primary btn-xs">
                                    Edit
                                </a>
                                <a href="{{route('books.destroy', $book)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                    Delete
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