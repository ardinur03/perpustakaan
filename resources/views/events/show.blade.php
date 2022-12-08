@extends('adminlte::page')

@section('title', 'Detail Events')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Events</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-pen" aria-hidden="true"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive mt-4">
                        <table class="table table-hover table-striped">
                            {{-- nama event --}}
                            <tr>
                                <th>Nama Event</th>
                                <td>{{ $event->event_name }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $event->event_description }}</td>
                            </tr>
                            <tr>
                                <th>Mulai</th>
                                <td>{{ $event->event_start_date }}</td>
                            </tr>
                            <tr>
                                <th>Selesai</th>
                                <td>{{ $event->event_end_date }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
