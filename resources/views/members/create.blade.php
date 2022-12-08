@extends('adminlte::page')

@section('title', 'Tambah Member')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Member</h1>
@stop

@section('content')
    <form action="{{ route('members.store') }}" method="post">
        @csrf
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="member-code">Kode Anggota</label>
                            <input type="number" class="form-control @error('member_code') is-invalid @enderror"
                                id="member-code" placeholder="Kode Anggota" name="member_code"
                                value="{{ old('member_code') }}">
                            @error('member_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="member-name">Nama Anggota</label>
                            <input type="text" class="form-control @error('member_name') is-invalid @enderror"
                                id="member-name" placeholder="Nama Anggota" name="member_name"
                                value="{{ old('member_name') }}">
                            @error('member_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror"
                                id="gender">
                                <option value="" selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="study_program">Program Studi</label>
                            <select name="study_program_id"
                                class="form-control @error('study_program') is-invalid @enderror" id="study_program">
                                <option value="" selected>Pilih Program Studi</option>
                                @foreach ($study_programs as $study_program)
                                    <option value="{{ $study_program->id }}">{{ $study_program->study_name }}</option>
                                @endforeach
                            </select>
                            @error('study_program')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone-number">Phone Number</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                id="phone-number" placeholder="Member Code" name="phone_number"
                                value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="5"
                                class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save mr-1" aria-hidden="true"></i>
                            Simpan
                        </button>
                        <a href="{{ route('members.index') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
