@extends('adminlte::page')

@section('title', 'Tambah Member')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Member</h1>
@stop

@section('content')
    <form action="{{route('members.store')}}" method="post">
        @csrf
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="member-code">Kode Anggota</label>
                            <input type="number" class="form-control @error('member_code') is-invalid @enderror" id="member-code" placeholder="Nama Anggota" name="member_code" value="{{old('member_code')}}">
                            @error('member_code') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="member-name">Nama Anggota</label>
                            <input type="text" class="form-control @error('member_name') is-invalid @enderror" id="member-name" placeholder="Nama Anggota" name="member_name" value="{{old('member_name')}}">
                            @error('member_name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender"  class="form-control @error('gender') is-invalid @enderror" id="gender">
                                <option value="" selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('gender') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone-number">Phone Number</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone-number" placeholder="Member Code" name="phone_number" value="{{old('phone_number')}}">
                            @error('phone_number') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="5" class="form-control @error('address') is-invalid @enderror">{{old('address')}}</textarea>
                            @error('address') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <hr>

                        <h3>Buat Akun untuk member</h3>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{old('email')}}">
                            @error('email') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password">
                            @error('password') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Konfirmasi Password" name="password_confirmation">
                            @error('password_confirmation') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('members.index')}}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop
