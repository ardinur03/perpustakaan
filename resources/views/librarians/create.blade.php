@extends('adminlte::page')

@section('title', 'Tambah Librarians')

@section('content_header')
<h1 class="m-0 text-dark">Tambah Librarians</h1>
@stop

@section('content')
<form action="{{route('librarians.store')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="librarian_name">Librarian Name</label>
                        <input type="text" class="form-control @error('librarian_name') is-invalid @enderror" id="exampleInputName" placeholder="Librarian Name" name="librarian_name" value="{{old('librarian_name')}}">
                        @error('librarian_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="Position">Position</label>
                        <input type="text" class="form-control @error('position') is-invalid @enderror" id="exampleInputName" placeholder="Position" name="position" value="{{old('position')}}">
                        @error('position') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="Gender">Gender</label>
                        <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="gender">
                            <option>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('gender') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="Phone-Number">Phone-Number</label>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="exampleInputName" placeholder="Phone-Number" name="phone_number" value="{{old('phone_number')}}">
                        @error('phone_number') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="Address">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="exampleInputName" placeholder="Address" name="address" value="{{old('address')}}">
                        @error('address') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('librarians.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    @stop