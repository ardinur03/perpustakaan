@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Daftar Buku</h1>
@stop

@section('content')
    <div class="row">
        @foreach ($books as $item => $value)
            @if ($value->stock != 0)
                <div class="col-4">
                    <div class="card card-primary" style="min-height: 100px;">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{-- limit string  --}}
                                {{ Str::limit($value->book_name, 25) }}
                            </h3>
                        </div>
                        <div class="card-body">
                            {{ $value->description }}
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('member.peminjaman-buku.store', $value->id) }}" class="btn btn-primary">Pinjam</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@stop
