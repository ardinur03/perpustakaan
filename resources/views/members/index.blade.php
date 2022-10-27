@extends('adminlte::page')

@section('title', 'List Members')

@section('content_header')
    <h1 class="m-0 text-dark">List Members</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('members.create')}}" class="btn btn-success mb-3">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </a>

                    <table class="table table-hover table-striped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Member Code</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $key => $member)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$member->member_code}}</td>
                                <td>{{$member->gender}}</td>
                                <td>{{$member->phone_number}}</td>
                                <td class="text-center">
                                    <a href="{{route('members.edit', $member)}}" class="btn btn-sm text-primary">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="{{route('members.destroy', $member)}}" onclick="notificationBeforeDelete(event, this)" class="btn text-danger btn-sm">
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
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

    </script>
@endpush
