@extends('layouts.admin')
@section('content')
@include('sweetalert::alert')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Posts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Posts</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Posts Data</h3>
                                <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus-circle mr-1"></i> Add Post
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="postsTable" class="table table-bordered table-hover w-100">
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
                                            <td>{{ Str::limit($item->judul, 30) }}</td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $item->category->name ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                @foreach ($item->tags as $tag)
                                                    <span class="badge badge-success mb-1">{{ $tag->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{!! Str::limit(strip_tags($item->content), 50) !!}</td>
                                            <td class="text-center">
                                                @if ($item->image)
                                                    <img src="{{ asset($item->image) }}" class="img-thumbnail"
                                                        style="max-height: 60px" alt="Post Image">
                                                @else
                                                    <span class="text-muted">No image</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->users->name ?? '-' }}</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('post.edit', $item->id) }}" class="btn btn-info"
                                                        title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('post.destroy', $item->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" title="Delete"
                                                            onclick="return confirm('Delete this post?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#postsTable').DataTable({
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
