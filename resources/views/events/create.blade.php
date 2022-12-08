@extends('adminlte::page')

@section('title', 'Tambah Event')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Event</h1>
@stop

@section('content')
    <form action="{{ route('events.store') }}" method="post">
        @csrf
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input_event_name">Nama Event</label>
                            <input type="text" class="form-control @error('event_name') is-invalid @enderror"
                                id="input_event_name" placeholder="Nama Event" name="event_name"
                                value="{{ old('event_name') }}">
                            @error('event_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_event_description">Deskripsi Event</label>
                            <textarea class="form-control @error('event_description') is-invalid @enderror" id="input_event_description"
                                placeholder="Deskripsi Event" name="event_description" rows="3">{{ old('event_description') }}</textarea>
                            @error('event_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_event_start_date">Mulai Event</label>
                            <input type="datetime-local"
                                class="form-control @error('event_start_date') is-invalid @enderror"
                                id="input_event_start_date" placeholder="Mulai Event" name="event_start_date"
                                value="{{ old('event_start_date') }}">
                            @error('event_start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_event_end_date">Selesai Event</label>
                            <input type="datetime-local" class="form-control @error('event_end_date') is-invalid @enderror"
                                id="input_event_end_date" placeholder="Selesai Event" name="event_end_date"
                                value="{{ old('event_end_date') }}">
                            @error('event_end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save mr-1" aria-hidden="true"></i>
                            Simpan
                        </button>
                        <a href="{{ route('events.index') }}" class="btn btn-default">

                            <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
