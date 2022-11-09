@extends('adminlte::page')

@section('title', 'List Study Programs')

@section('content_header')
<h1 class="m-0 text-dark">List Study Programs</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <a href="{{route('study-programs.create')}}" class="btn btn-success mb-3">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                </a>

                <table class="table table-hover table-striped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Study Name</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studyprograms as $key => $studyprogram)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$studyprogram->study_name}}</td>
                            <td class="text-center">
                                <a href="{{route('study-programs.edit', $studyprogram)}}" class="btn text-primary btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="{{route('study-programs.destroy', $studyprogram)}}" onclick="notificationBeforeDelete(event, this)" class="btn text-danger btn-sm">
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