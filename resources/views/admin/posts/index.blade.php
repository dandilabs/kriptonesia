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
                    <h1 class="m-0">List Posts</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('post.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">List Posts</li>
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
                                <a href="{{route('post.create')}}" class="btn btn-block btn-outline-primary">
                                    <i class="fa fa-plus-circle"></i> Add </a>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Category</th>
                                        <th>Tags</th>
                                        <th>Content</th>
                                        <th>Image</th>
                                        <th>Creator</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($post as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>
                                                @foreach ($item->tags as $tag)
                                                    <span class="badge badge-success">{{ $tag->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $item->content }}</td>
                                            <td>
                                                <img src="{{asset($item->image)}}" class="img-fluid mb-2" style="width: 250px" alt="">
                                            </td>
                                            <td><span class="badge badge-info">{{ $item->users->name }}</span> </td>
                                            <td class="project-actions text-center">
                                                <form action="{{route('post.destroy', $item->id )}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{route('post.edit', $item->id)}}" class="btn btn-outline-primary btn-sm"> <i class="fas fa-pencil-alt">
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
