@extends('adminlte::page')

@section('title', 'Kategori Buku')

@section('content_header')
<h1 class="m-0 text-dark">Kategori Buku</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <a href="{{route('categories.create')}}" class="btn btn-success mb-2">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <i class="fa fa-category_name" aria-hidden="true"></i>
                </a>

                <table class="table table-hover table-striped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th class="text-center">Kategori Buku</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->category_name}}</td>
                            <td class="text-center">
                                <a href="{{route('categories.edit', $value)}}" class="btn text-primary btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="{{route('categories.destroy', $value)}}" onclick="notificationBeforeDelete(event, this)" class="btn text-danger btn-sm">
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
</script>
@endpush