@extends('adminlte::page')

@section('title', 'List Librarians')

@section('content_header')
<h1 class="m-0 text-dark">List Librarians</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <a href="{{route('librarians.create')}}" class="btn btn-primary mb-2">
                    Tambah
                </a>

                <table class="table table-hover table-bordered table-stripped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($librarians as $key => $librarian)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$librarian->librarian_name}}</td>
                            <td>{{$librarian->position}}</td>
                            <td>{{$librarian->gender}}</td>
                            <td>{{$librarian->phone_number}}</td>
                            <td>
                                <a href="{{route('librarians.edit', $librarian)}}" class="btn btn-primary btn-xs">
                                    Edit
                                </a>
                                <a href="{{route('librarians.destroy', $librarian)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                    Delete
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