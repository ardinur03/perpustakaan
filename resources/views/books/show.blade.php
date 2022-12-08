@extends('adminlte::page')

@section('title', 'List Books')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Books</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-pen" aria-hidden="true"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="row justify-content-center mt-2 ">
                <div class="col-md-auto">
                    <img id="preview" class="img-thumbnail" width="500px" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive mt-4">
                        <table class="table table-hover table-striped">
                            <tr>
                                <th>Judul Buku</th>
                                <td>{{ $book->book_name }}</td>
                            </tr>
                            <tr>
                                <th>Penerbit</th>
                                <td>{{ $book->publisher }}</td>
                            </tr>
                            <tr>
                                <th>author</th>
                                <td>{{ $book->author }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>{{ $book->category->category_name }}</td>
                            </tr>
                            <tr>
                                <th>Stok Tersedia</th>
                                <td>{{ $book->stock }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $book->description }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Publis</th>
                                <td>{{ $book->published_year }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $book->created_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        // cek apakah ada gambar pada database atau tidak
        let image = "{{ $book->image ?? '' }}";
        if (image) {
            // jika image merupakan link https maka tampilkan gambar dari link tersebut ke preview image 
            if (image.includes('https')) {
                $('#preview').attr('src', image);
            } else {
                // jika image merupakan nama file maka tampilkan gambar dari storage
                $('#preview').attr('src', "{{ asset('storage/books/' . $book->image) }}");
            }
        }
    </script>
@stop
