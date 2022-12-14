@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1 class="m-0 text-dark">Edit User</h1>
@stop

@section('content')
    <form action="{{ route('books.update', $book) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input_book_name">Judul Buku</label>
                            <input type="text" class="form-control @error('book_name') is-invalid @enderror"
                                id="input_book_name" placeholder="Judul Buku" name="book_name"
                                value="{{ $book->book_name ?? old('book_name') }}">
                            @error('book_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="preview">Preview Image</label>
                            <div class="input-group">
                                <img id="preview" class="img-thumbnail" width="200px" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_gambar">Gambar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-group-image">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                        id="input-image" aria-describedby="input-group-image" name="image"
                                        value="{{ $book->image ?? old('image') }}">
                                    <label class="custom-file-label" for="input-image">Masukkan File</label>
                                </div>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_page">Jumlah Halaman</label>
                            <input type="number" min="0" class="form-control @error('page') is-invalid @enderror"
                                id="input_page" placeholder="Jumlah Halaman" name="page"
                                value="{{ $book->page ?? old('page') }}">
                            @error('page')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_description">Deskripsi</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                id="input_description" placeholder="Deskripsi" name="description"
                                value="{{ $book->description ?? old('description') }}"">
                            @error('description')
                                <span class=" text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_publisher">Penerbit</label>
                            <input type="text" class="form-control @error('publisher') is-invalid @enderror"
                                id="input_publisher" placeholder="Penerbit" name="publisher"
                                value="{{ $book->publisher ?? old('publisher') }}">
                            @error('publisher')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_penulis">Penulis</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror"
                                id="input_penulis" placeholder="Penulis" name="author"
                                value="{{ $book->author ?? old('author') }}">
                            @error('author')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="input_stock">Stok</label>
                            <input type="number" min="0" class="form-control @error('stock') is-invalid @enderror"
                                id="input_stock" placeholder="Stok" name="stock"
                                value="{{ $book->stock ?? old('stock') }}">
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group>
                        <label for="input_category">Kategori</label>
                            <select class="form-control" name="category_id" id="input_category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $book->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="input_published_year">Tahun Terbit</label>
                                <input type="date" class="form-control @error('published_year') is-invalid @enderror"
                                    id="input_published_year" placeholder="Tahun Terbit" name="published_year"
                                    value="{{ $book->published_year ?? old('published_year') }}">
                                @error('published_year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"
                                aria-hidden="true"></i> Simpan</button>
                        <a href="{{ route('books.index') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#input-image').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#input-image").change(function() {
            readURL(this);
        });

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

        // convert nama image dan tampilkan kedalam label
        let fileName = "{{ $book->image ?? '' }}";
        if (fileName) {
            $('#input-image').next('.custom-file-label').addClass("selected").html(fileName);
        }
    </script>
@stop
