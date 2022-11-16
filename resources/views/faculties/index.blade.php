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

                <a href="{{route('faculties.create')}}" class="btn btn-success mb-2">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <i class="fa fa-faculty_name" aria-hidden="true"></i>
                </a>

                <table class="table table-hover table-striped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Fakultas</th>
                            <th>Program Study</th
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faculties as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->faculty_name}}</td>
                            <td>{{$value->studyProgram->study_name}}</td>
                            
                            <td class="text-center">
                                <a href="{{route('faculties.edit', $value)}}" class="btn text-primary btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="{{route('faculties.destroy', $value)}}" onclick="notificationBeforeDelete(event, this)" class="btn text-danger btn-sm">
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