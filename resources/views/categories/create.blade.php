@extends('adminlte::page')

@section('title', 'Tambah Kategori')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Kategori</h1>
@stop

@section('content')
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input_category">Kategori Buku</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                id="input_category" placeholder="Kategori buku" name="category_name"
                                value="{{ old('category_name') }}">
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save mr-1" aria-hidden="true"></i>
                            Simpan
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-default">

                            <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
