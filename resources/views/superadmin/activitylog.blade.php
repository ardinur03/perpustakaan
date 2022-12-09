@extends('adminlte::page')

@section('title', 'List User')

@section('content_header')
    <h1 class="m-0 text-dark">Activity Logs</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-striped yajra-datatables w-100" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Log</th>
                                    <th>Deskripsi</th>
                                    <th>Subjek ID</th>
                                    <th>Subjek Type</th>
                                    <th>Waktu dibuat</th>
                                    <th>Properti</th>
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
    <script>
        $(function() {
            $('.yajra-datatables').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [1, 'desc']
                ],
                ajax: "{{ route('superadmin.activity-log') }}",
                columns: [{
                        data: 'no',
                        name: 'no'
                    },
                    {
                        data: 'log_name',
                        name: 'log_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'subject_id',
                        name: 'subject_id'
                    },
                    {
                        data: 'subject_type',
                        name: 'subject_type'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'properties',
                        name: 'properties',
                    }
                ]
            });
        });
    </script>
@endpush
