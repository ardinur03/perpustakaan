@extends('layouts.app-landing')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($books as $key => $book)
                <div class="col-3">
                    <div class="card m-2" style="height: 300px">
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($book->book_name, 32) }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ Str::limit($book->author, 32) }},
                                {{ $book->publisher }}</h6>
                            <p class="card-text">{{ Str::limit($book->description, 40) }}</p>
                        </div>
                        <div class="card-footer d-grid gap-2">
                            <button type="button" class="btn btn-success">Pinjam</button>
                            <button type="button" class="btn btn-outline-secondary">Detail</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $books->links() }}
        </div>
    </div>
@endsection
