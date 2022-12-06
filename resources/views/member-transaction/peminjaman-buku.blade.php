@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Daftar Buku</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-6">
            <form action="" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Buku" name="book">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
                            <a href="{{ route('member.peminjaman-buku.store', $value->id) }}"
                                class="btn btn-success">Pinjam</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="row mt-4">
        <div class="col">
            {{ $books->links() }}

        </div>
    </div>
@stop
