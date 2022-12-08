@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1 class="m-0 text-dark">Edit User</h1>
@stop

@section('content')
    <form action="{{ route('categories.update', $category) }}" method="post">
        @method('PUT')
        @csrf
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input_category">Kategori Buku</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                id="input_category" placeholder="Judul Buku" name="category_name"
                                value="{{ $category->category_name ?? old('category_name') }}">
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"
                            aria-hidden="true"></i>Simpan</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-default">
                        <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
        </div>
    @stop
