@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
<h1 class="m-0 text-dark">Edit User</h1>
@stop

@section('content')
<form action="{{route('books.update', $book)}}" method="post">
    @method('PUT')
    @csrf
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="input_book_name">Judul Buku</label>
                        <input type="text" class="form-control @error('book_name') is-invalid @enderror" id="input_book_name" placeholder="Judul Buku" name="book_name" value="{{$book->book_name ?? old('book_name')}}">
                        @error('book_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="input_page">Jumlah Halaman</label>
                        <input type="number" min="0" class="form-control @error('page') is-invalid @enderror" id="input_page" placeholder="Jumlah Halaman" name="page" value="{{$book->page ?? old('page')}}">
                        @error('page') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="input_description">Deskripsi</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="input_description" placeholder="Deskripsi" name="description" value="{{$book->description ?? old('description')}}"">
                        @error('description') <span class=" text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="input_publisher">Penerbit</label>
                        <input type="text" class="form-control @error('publisher') is-invalid @enderror" id="input_publisher" placeholder="Penerbit" name="publisher" value="{{$book->publisher ?? old('publisher')}}">
                        @error('publisher') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="input_penulis">Penulis</label>
                        <input type="text" class="form-control @error('author') is-invalid @enderror" id="input_penulis" placeholder="Penulis" name="author" value="{{$book->author ?? old('author')}}">
                        @error('author') <span class="text-danger">{{$message}}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="input_stock">Stok</label>
                        <input type="number" min="0" class="form-control @error('stock') is-invalid @enderror" id="input_stock" placeholder="Stok" name="stock" value="{{$book->stock ?? old('stock')}}">
                        @error('stock') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="input_category">Kategori</label>
                        <select name="category_id" id="input_category" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                            <option value="{{$study_program->id}}" {{old('study_program_id') == $study_program->id ? 'selected' : ''}}>{{$study_program->study_name}}</option>
                            @endforeach
                        </select>
                        @error('category') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="input_published_year">Tahun Terbit</label>
                        <input type="date" class="form-control @error('published_year') is-invalid @enderror" id="input_published_year" placeholder="Tahun Terbit" name="published_year" value="{{$book->published_year ?? old('published_year')}}">
                        @error('published_year') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{route('books.index')}}" class="btn btn-default">
                    Batal
                </a>
            </div>
        </div>
    </div>
    </div>
    @stop