@extends('adminlte::page')

@section('title', 'Tambah User')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Buku</h1>
@stop

@section('content')
    <form action="{{ route('books.store') }}" method="post">
        @csrf
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input_book_name">Judul Buku</label>
                            <input type="text" class="form-control @error('book_name') is-invalid @enderror"
                                id="input_book_name" placeholder="Judul Buku" name="book_name"
                                value="{{ old('book_name') }}">
                            @error('book_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_page">Jumlah Halaman</label>
                            <input type="number" min="0" class="form-control @error('page') is-invalid @enderror"
                                id="input_page" placeholder="Jumlah Halaman" name="page" value="{{ old('page') }}">
                            @error('page')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_description">Deskripsi</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                id="input_description" placeholder="Deskripsi" name="description"
                                value="{{ old('description') }}">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_publisher">Penerbit</label>
                            <input type="text" class="form-control @error('publisher') is-invalid @enderror"
                                id="input_publisher" placeholder="Penerbit" name="publisher" value="{{ old('publisher') }}">
                            @error('publisher')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_penulis">Penulis</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror"
                                id="input_penulis" placeholder="Penulis" name="author" value="{{ old('author') }}">
                            @error('author')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="input_stock">Stok</label>
                            <input type="number" min="0" class="form-control @error('stock') is-invalid @enderror"
                                id="input_stock" placeholder="Stok" name="stock" value="{{ old('stock') }}">
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_category">Kategori</label>
                            <select name="category_id" id="input_category"
                                class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="input_published_year">Tahun Terbit</label>
                            <input type="date" class="form-control @error('published_year') is-invalid @enderror"
                                id="input_published_year" placeholder="Tahun Terbit" name="published_year"
                                value="{{ old('published_year') }}">
                            @error('published_year')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('books.index') }}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @stop
