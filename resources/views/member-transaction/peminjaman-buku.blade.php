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
        <div class="col-6">
            <form action="" method="GET">
                <div class="input-group mb-3">
                    <select class="form-control" name="category">
                        <option selected value="">Filter Berdasarkan Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @foreach ($books->chunk(3) as $item)
        <div class="row mt-3">
            @foreach ($item as $key => $book)
                <div class="col-md-4">
                    <div class="card m-2 shadow" style="height: 30rem;">
                        <img src="{{ $book->image == '' ? asset('assets/images/default-book.jpg') : (strpos($book->image, 'https') !== false ? $book->image : asset('storage/books/' . $book->image)) }}"
                            style="height: 15rem;" class="card-img-top" alt="image-book">
                        <div class="card-body mt-3">
                            <h5 class="card-subtitle mb-2 text-truncate">{{ $book->book_name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <i class="fas fa-user fa-sm"></i> :
                                {{ $book->author }}
                            </h6>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <i class="fas fa-book fa-sm"></i> :
                                {{ $book->publisher }}
                            </h6>
                            <h6 class="card-subtitle text-muted">
                                <i class="fas fa-fw fa-tags fa-sm"></i> :
                                {{ $book->category->category_name }}
                            </h6>
                        </div>
                        <div class="card-footer d-grid gap-2">


                            @if ($book->stock == 0)
                                <button type="button" class="btn btn-danger btn-block btn-pinjam" disabled>Stok Buku
                                    Habis</button>
                            @elseif ($book->stock > 0)
                                <a href="{{ route('member.peminjaman-buku.store', $book->id) }}"
                                    class="btn btn-success btn-block btn-pinjam">Pinjam</a>
                            @endif

                            {{-- show detail modal from controller --}}
                            <button type="button" class="btn btn-outline-secondary btn-block btn-pinjam"
                                data-toggle="modal" data-target="#detailModal{{ $book->id }}">
                                Detail
                            </button>

                            <x-detail-book :book="$book" />

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    <div class="d-flex justify-content-center mt-5">
        {{ $books->links() }}
    </div>
@stop

@push('css')
    <style>
        .btn-pinjam {
            border-radius: 150px;
        }

        .btn-pinjam:hover {
            transition: 0.3s;
        }
    </style>
@endpush
