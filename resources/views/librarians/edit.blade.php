@extends('adminlte::page')

@section('title', 'Edit Librarians')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Librarians</h1>
@stop

@section('content')
    <form action="{{ route('librarians.update', $librarian) }}" method="post">
        @method('PUT')
        @csrf
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="librarian_name">Nama Petugas</label>
                            <input type="text" class="form-control @error('librarian_name') is-invalid @enderror"
                                id="exampleInputName" placeholder="Nama Petugas" name="librarian_name"
                                value="{{ $librarian->librarian_name ?? old('librarian_name') }}">
                            @error('librarian_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Position">Posisi</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror"
                                id="exampleInputName" placeholder="Posisi" name="position"
                                value="{{ $librarian->position ?? old('position') }}">
                            @error('position')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Gender">Jenis Kelamin</label>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror"
                                id="gender">
                                <option value="Laki-laki" @if ($librarian->gender == 'Laki-laki') selected @endif>Laki-laki
                                </option>
                                <option value="Perempuan" @if ($librarian->gender == 'Perempuan') selected @endif>Perempuan
                                </option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Phone-Number">Nomor Telepon</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                id="exampleInputName" placeholder="Nomor Telepon" name="phone_number"
                                value="{{ $librarian->phone_number ?? old('phone_number') }}">
                            @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Address">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="5"
                                class="form-control @error('address') is-invalid @enderror">{{ $librarian->address ?? old('address') }}</textarea>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"
                                aria-hidden="true"></i>Simpan</button>
                        <a href="{{ route('librarians.index') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @stop
