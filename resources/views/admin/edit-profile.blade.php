@extends('adminlte::page')

@section('title', 'Edit Anggota Perpustakaan')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Petugas Perpustakaan</h1>
@stop

@section('content')
    <form action="{{ route('admin.update-profile') }}" method="post">
        @method('POST')
        @csrf
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">

                        {{-- email --}}
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="Email" name="email" value="{{ $user->email ?? old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- username --}}
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" placeholder="Username" name="username"
                                value="{{ $user->username ?? old('username') }}">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="librarian-name">Nama Lengkap</label>
                            <input type="text" class="form-control @error('librarian_name') is-invalid @enderror"
                                id="librarian-name" placeholder="Nama Petugas" name="librarian_name"
                                value="{{ $librarian->librarian_name ?? old('librarian_name') }}">
                            @error('librarian_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- position --}}
                        <div class="form-group">
                            <label for="position">Jabatan</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror"
                                id="position" placeholder="Jabatan" name="position"
                                value="{{ $librarian->position ?? old('position') }}">
                            @error('position')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- gender --}}
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
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

                        {{-- phone number --}}
                        <div class="form-group">
                            <label for="phone-number">Nomor Telepon</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                id="phone-number" placeholder="Nomor Telepon" name="phone_number"
                                value="{{ $librarian->phone_number ?? old('phone_number') }}">
                            @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="form-group">
                            <label for="address">Alamat</label>
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
                        <a href="{{ route('admin.profile') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
