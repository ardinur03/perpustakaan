@extends('adminlte::page')

@section('title', 'List Events')

@section('content_header')
    <h1 class="m-0 text-dark">List Events</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('events.create') }}" class="btn btn-success mb-2">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </a>

                    <table class="table table-hover table-striped yajra-datatables" id="events">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Event</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->event_name }}</td>
                                    <td>{{ $value->event_start_date }}</td>
                                    <td>{{ $value->event_end_date }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('send.event.to.all.member', $value) }}"
                                            onclick="notificationBeforeSendEvent(event, this)"
                                            class="btn text-secondary btn-md">
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('events.edit', $value) }}" class="btn text-primary btn-md">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('events.destroy', $value) }}"
                                            onclick="notificationBeforeDelete(event, this)" class="btn text-danger btn-md">
                                            <i class="fas fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>

    <form action="" id="send-to-member" method="post">
        @csrf
    </form>

    <script>
        $('#events').DataTable({
            "responsive": true,
        });

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#5C636A',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.dismiss != 'cancel' && result) {
                    $('#delete-form').attr('action', $(el).attr('href'));
                    $('#delete-form').submit();
                }
            })
        }

        function notificationBeforeSendEvent(event, el) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan mengirimkan informasi event ini via email ke semua member perpustakaan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#5C636A',
                confirmButtonText: 'Ya, kirim!'
            }).then((result) => {
                if (result.dismiss != 'cancel' && result) {
                    $('#send-to-member').attr('action', $(el).attr('href'));
                    $('#send-to-member').submit();
                }
            })
        }
    </script>
@endpush
