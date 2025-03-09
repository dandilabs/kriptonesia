@extends('layouts.admin')
@section('content')

@if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session('success') }}
        </div>
@endif
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Tags</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">List Tags</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{route('tag.create')}}" class="btn btn-block btn-outline-primary">
                                    <i class="fa fa-plus-circle"></i> Add </a>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td class="text-center">
                                                <form action="{{route('tag.destroy', $item->id )}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{route('tag.edit', $item->id)}}" class="btn btn-outline-primary btn-sm"> <i class="fas fa-pencil-alt">
                                                    </i> Edit</a>
                                                    <button type="submit" class="btn btn-outline-danger btn-sm"> <i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#example2').DataTable({
                "paging": true, // Aktifkan pagination
                "lengthChange": true, // Tambahkan pilihan jumlah data per halaman
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 10 // Set jumlah data default per halaman
            });
        });
    </script>
@endpush
