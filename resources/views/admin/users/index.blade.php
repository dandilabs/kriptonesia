@extends('layouts.admin')
@section('title', 'User Management')
@section('content')
    @include('sweetalert::alert')

    <style>
        .card-header-custom {
            background-color: #f8fafc;
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            padding: 1rem 1.25rem;
        }

        .badge-custom {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 0.25rem;
        }

        .action-btns .btn {
            width: 30px;
            height: 30px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 2px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 4px;
            border: 1px solid #ddd;
            padding: 4px 10px;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 4px;
            border: 1px solid #ddd;
        }
    </style>

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">User List</h3>
                            <div>
                                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus-circle mr-1"></i> Add New User
                                </a>
                            </div>
                        </div>

                        <div class="card-body pt-3">
                            <div class="table-responsive">
                                <table id="users-table" class="table table-hover table-striped w-100">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>User</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Membership</th>
                                            <th>Expiry</th>
                                            <th>Role</th>
                                            <th>Registered</th>
                                            <th width="12%" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-40 symbol-light-primary mr-3">
                                                            <span class="symbol-label">
                                                                <span class="svg-icon svg-icon-xl">
                                                                    <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}"
                                                                        class="img-circle" width="30" alt="User">
                                                                </span>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span
                                                                class="text-dark font-weight-bold">{{ $item->name }}</span>
                                                            @if ($item->email_verified_at)
                                                                <small class="text-success">
                                                                    <i class="fas fa-check-circle"></i> Verified
                                                                </small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    @if ($item->payment_status == 'paid')
                                                        <span class="badge-custom badge-success">Active</span>
                                                    @elseif($item->payment_status == 'verifying')
                                                        <span class="badge-custom badge-info">Verifying</span>
                                                    @else
                                                        <span class="badge-custom badge-secondary">Free</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge-custom
                                                    @if (str_contains($item->membership_type, 'lifetime')) badge-primary
                                                    @elseif(str_contains($item->membership_type, 'news')) badge-info
                                                    @else badge-success @endif">
                                                        {{ ucwords(str_replace('_', ' ', $item->membership_type)) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($item->expired_at)
                                                        <div class="d-flex flex-column">
                                                            <span>{{ \Carbon\Carbon::parse($item->expired_at)->format('d M Y') }}</span>
                                                            @if (now() > \Carbon\Carbon::parse($item->expired_at))
                                                                <small class="text-danger">Expired</small>
                                                            @endif
                                                        </div>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->role == 1)
                                                        <span class="badge-custom badge-danger">Admin</span>
                                                    @else
                                                        <span class="badge-custom badge-warning">User</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span data-toggle="tooltip"
                                                        title="{{ $item->created_at->format('d M Y H:i') }}">
                                                        {{ $item->created_at->diffForHumans() }}
                                                    </span>
                                                </td>
                                                <td class="text-center action-btns">
                                                    <a href="{{ route('user.edit', $item->id) }}"
                                                        class="btn btn-sm btn-icon btn-info" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{ route('admin.user.detail', $item->id) }}"
                                                        class="btn btn-sm btn-icon btn-secondary" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger"
                                                        data-toggle="modal" data-target="#deleteModal{{ $item->id }}"
                                                        title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                                role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Delete</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete user
                                                                <strong>{{ $item->name }}</strong>?</p>
                                                            <p class="text-danger">This action cannot be undone.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <form action="{{ route('user.destroy', $item->id) }}"
                                                                method="POST">
                                                                @csrf @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search...",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                columnDefs: [{
                        orderable: false,
                        targets: [8]
                    },
                    {
                        responsivePriority: 1,
                        targets: 1
                    },
                    {
                        responsivePriority: 2,
                        targets: 8
                    },
                    {
                        className: "text-center",
                        targets: [8]
                    }
                ],
                initComplete: function() {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
    </script>
@endpush
