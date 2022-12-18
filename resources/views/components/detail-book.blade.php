<div>
    <div class="modal fade" id="detailModal{{ $book->id }}" tabindex="-1" role="dialog"
        aria-labelledby="detailModalLabel{{ $book->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel{{ $book->id }}">Detail Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <img src="{{ $book->image == '' ? asset('assets/images/default-book.jpg') : (strpos($book->image, 'https') !== false ? $book->image : asset('storage/books/' . $book->image)) }}"
                                    style="height: 15rem;" class="card-img-top" alt="image-book">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body mt-3">
                                    <h5 class="card-subtitle mb-2">{{ $book->book_name }}</h5>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
