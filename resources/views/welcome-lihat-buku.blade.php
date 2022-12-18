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

                            {{-- cek jika guest maka tidak akan muncul --}}
                            @auth
                                <div class="card-footer d-grid gap-2">

                                    @if (Auth::user()->roles->pluck('name')[0] == 'super-admin' || Auth::user()->roles->pluck('name')[0] == 'petugas')
                                        <a href="{{ route('books.edit', $book->id) }}"
                                            class="btn btn-outline-primary btn-pinjam">Edit</a>
                                    @elseif (Auth::user()->roles->pluck('name')[0] == 'member')
                                        <a href="{{ route('member.peminjaman-buku.store', $book->id) }}"
                                            onclick="notificationBeforeBorrow(event, this)"
                                            class="btn btn-success btn-block btn-pinjam">Pinjam</a>
                                        <button type="button" class="btn btn-outline-secondary btn-pinjam"
                                            data-bs-toggle="modal" data-bs-target="#detailBook{{ $book->id }}">
                                            Detail
                                        </button>
                                        <div class="modal fade" id="detailBook{{ $book->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail
                                                            Buku</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md-6 align-self-center">
                                                                    <img src="{{ $book->image == '' ? asset('assets/images/default-book.jpg') : (strpos($book->image, 'https') !== false ? $book->image : asset('storage/books/' . $book->image)) }}"
                                                                        style="height: 15rem;" class="card-img-top"
                                                                        alt="image-book">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="card-body mt-3">
                                                                        <h5 class="card-subtitle mb-2">{{ $book->book_name }}
                                                                        </h5>
                                                                        <div class="mt-3">
                                                                            <h6 class="card-subtitle mb-2 text-muted">
                                                                                <i class="fas fa-user fa-sm"></i> :
                                                                                {{ $book->author }}
                                                                            </h6>
                                                                        </div>
                                                                        <div class="mt-3">
                                                                            <h6 class="card-subtitle mb-2 text-muted">
                                                                                <i class="fas fa-book fa-sm"></i> :
                                                                                {{ $book->publisher }}
                                                                            </h6>
                                                                        </div>
                                                                        <div class="mt-3">
                                                                            <h6 class="card-subtitle text-muted">
                                                                                <i class="fas fa-fw fa-tags fa-sm"></i> :
                                                                                {{ $book->category->category_name }}
                                                                            </h6>
                                                                        </div>
                                                                        <div class="mt-3">
                                                                            <h6 class="card-subtitle text-muted">
                                                                                <i class="fas fa-fw fa-calculator fa-sm"></i> :
                                                                                {{ $book->stock }}
                                                                            </h6>
                                                                        </div>
                                                                        <div class="mt-3">
                                                                            <h6 class="card-subtitle text-muted">
                                                                                <i class="fas fa-fw fa-book-open fa-sm"></i> :
                                                                                {{ $book->description }}
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-5">
            {{ $books->links() }}
        </div>

        <x-notification-component />

    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <form action="" id="post-form" method="get">
        @csrf
    </form>
    <script>
        function notificationBeforeBorrow(event, el) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan meminjam buku ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, pinjam!'
            }).then((result) => {
                if (result.dismiss != 'cancel' && result) {
                    $("#post-form").attr('action', $(el).attr('href'));
                    $("#post-form").submit();
                }
            })
        };
    </script>
@endpush
