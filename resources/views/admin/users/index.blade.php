@extends('layouts.admin')
@section('content')

@include('sweetalert::alert')
    <!-- Content Header (Page header) -->
    <style>
        .badge {
            font-size: 0.8em;
            font-weight: normal;
            padding: 5px 8px;
        }

        .badge-primary {
            background-color: #007bff;
        }

        .badge-info {
            background-color: #17a2b8;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .badge-secondary {
            background-color: #6c757d;
        }

        .btn-group-sm>.btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.765625rem;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
                        <li class="breadcrumb-item active">List Users</li>
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
                                <a href="{{ route('user.create') }}" class="btn btn-block btn-outline-primary">
                                    <i class="fa fa-plus-circle"></i> Add </a>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status Pembayaran</th>
                                        <th>Membership</th>
                                        <th>Masa Berlaku</th>
                                        <th>Role</th>
                                        <th>Terdaftar</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $item->name }}
                                                @if ($item->email_verified_at)
                                                    <i class="fas fa-check-circle text-success ml-1"
                                                        title="Email Terverifikasi"></i>
                                                @endif
                                            </td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->payment_status == 'paid')
                                                    <span class="badge badge-success">Aktif</span>
                                                @elseif($item->payment_status == 'verifying')
                                                    <span class="badge badge-info">Verifikasi</span>
                                                @else
                                                    <span class="badge badge-secondary">Free</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge
                                                @if (str_contains($item->membership_type, 'lifetime')) badge-primary
                                                @elseif(str_contains($item->membership_type, 'news')) badge-info
                                                @else badge-success @endif">
                                                    {{ ucwords(str_replace('_', ' ', $item->membership_type)) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($item->expired_at)
                                                {{ \Carbon\Carbon::parse($item->expired_at)->format('d M Y') }}
                                                    @if(now() > \Carbon\Carbon::parse($item->expired_at))
                                                        <span class="badge badge-danger">Expired</span>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->role == 1)
                                                    <span class="badge badge-danger">Admin</span>
                                                @else
                                                    <span class="badge badge-warning">User</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-info"
                                                        title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#deleteModal{{ $item->id }}" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <a href="{{ route('admin.user.detail', $item->id) }}" class="btn btn-secondary" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                                <button type="button" class="close" data-dismiss="modal">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Yakin menghapus user {{ $item->name }}?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('user.destroy', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf @method('DELETE')
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@push('js')
<script>
    $(function () {
        $('#example2').DataTable({
            "responsive": true,
            "autoWidth": false,
            "columnDefs": [
                { "orderable": false, "targets": [8] }, // Non-aktifkan sorting untuk kolom aksi
                { "width": "10%", "targets": [8] } // Atur lebar kolom aksi
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json" // Bahasa Indonesia
            }
        });
    });
</script>
@endpush
