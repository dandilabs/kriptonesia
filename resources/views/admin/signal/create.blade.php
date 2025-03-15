@extends('layouts.admin')
@section('content')
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
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
                    <h1 class="m-0">Add Signal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('signal-trade.index') }}">Back</a></li>
                        <li class="breadcrumb-item active">Add Signal</li>
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
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Signal</h3>
                        </div>
                        <form method="post" action="{{ route('signal-trade.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea name="content" class="form-control" id="content"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
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
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>

<script>
        $(function () {
        // Summernote
        $('#summernote').summernote()
        })
    </script>
@endpush
