@extends('layouts.app-landing')

@section('content')
    <div class="container">
        <div class="row mt-3">
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
                        <select class="form-select" name="category">
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
        @foreach ($books->chunk(4) as $item)
            <div class="row mt-3">
                @foreach ($item as $key => $book)
                    <div class="col-md-3">
                        <div class="card m-2 s-md" style="height: 25rem;">
                            {{-- cek book->image kosong maka munculkan image default dan jika ada dan terdapat https maka munculkan --}}
                            <img src="{{ $book->image == '' ? asset('assets/images/default-book.jpg') : (strpos($book->image, 'https') !== false ? $book->image : asset('storage/books/' . $book->image)) }}"
                                style="height: 15rem;" class="card-img-top" alt="image-book">
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $book->book_name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <i class="fas fa-user fa-sm"></i> :
                                    {{ $book->author }}
                                </h6>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <i class="fas fa-book fa-sm"></i> :
                                    {{ $book->publisher }}
                                </h6>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <i class="fas fa-fw fa-tags fa-sm"></i> :
                                    {{ $book->category->category_name }}
                                </h6>
                            </div>
                            <div class="card-footer d-grid gap-2">
                                <button type="button" class="btn btn-success btn-pinjam">Pinjam</button>
                                <button type="button" class="btn btn-outline-secondary btn-pinjam">Detail</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        <div class="d-flex justify-content-center mt-5">
            {{ $books->links() }}
        </div>
    </div>
@endsection
