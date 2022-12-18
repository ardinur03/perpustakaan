@extends('adminlte::page')

@section('title', 'Fakultas')

@section('content_header')
    <h1 class="m-0 text-dark">Fakultas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('faculties.create') }}" class="btn btn-success mb-2">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped yajra-datatables w-100" id="faculties">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Fakultas</th>
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
    <script>
        var table = $('#faculties').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('faculties.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'faculty_name',
                    name: 'faculty_name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
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
                console.log(result);
                if (result.dismiss != 'cancel' && result) {
                    $('#delete-form').attr('action', $(el).attr('href'));
                    $('#delete-form').submit();
                }
            })
        }
        table.on('draw.dt', function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
