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
                    <div class="table-responsive">
                        <table class="table table-hover table-striped yajra-datatables w-100" id="events">
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
                            </tbody>
                        </table>
                    </div>
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
        var table = $('#events').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('events.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'event_name',
                    name: 'event_name'
                },
                {
                    data: 'event_start_date',
                    name: 'event_start_date'
                },
                {
                    data: 'event_end_date',
                    name: 'event_end_date'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
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
