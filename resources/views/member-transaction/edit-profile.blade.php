@extends('adminlte::page')

@section('title', 'Edit Anggota Perpustakaan')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Anggota Perpustakaan</h1>
@stop

@section('content')
    <form action="{{ route('member.update-profile') }}" method="post">
        @method('POST')
        @csrf
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="member-name">Nama Lengkap</label>
                            <input type="text" class="form-control @error('member_name') is-invalid @enderror"
                                id="member-name" placeholder="Nama Anggota" name="member_name"
                                value="{{ $member->member_name ?? old('member_name') }}">
                            @error('member_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror"
                                id="gender">
                                <option value="Laki-laki" @if ($member->gender == 'Laki-laki') selected @endif>Laki-laki
                                </option>
                                <option value="Perempuan" @if ($member->gender == 'Perempuan') selected @endif>Perempuan
                                </option>
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
                                    <option value="{{ $study_program->id }}"
                                        {{ $study_program->id == $member->study_program_id ? 'selected' : '' }}>
                                        {{ $study_program->study_name }}</option>
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
                                value="{{ $member->phone_number ?? old('phone_number') }}">
                            @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="5"
                                class="form-control @error('address') is-invalid @enderror">{{ $member->address ?? old('address') }}</textarea>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"
                                aria-hidden="true"></i>Simpan</button>
                        <a href="{{ route('member.profile') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
