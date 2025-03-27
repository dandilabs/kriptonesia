@extends('layouts.admin')

@section('title', 'User Detail')

@section('content')

    @include('sweetalert::alert')
    <style>
        .profile-user-img {
            border: 3px solid #adb5bd;
            margin: 0 auto;
            padding: 3px;
            width: 100px;
        }

        .box-profile {
            text-align: center;
        }

        .list-group-unbordered {
            >.list-group-item {
                border-left: 0;
                border-right: 0;
                padding: 0.75rem 0;
            }
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Back</a></li>
                        <li class="breadcrumb-item active">Detail Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('adminlte/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->name }}</h3>

                        <p class="text-muted text-center">{{ $user->email }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Member Since</b>
                                <span class="float-right">
                                    {{ $user->created_at->format('d M Y') }}
                                </span>
                            </li>
                            <li class="list-group-item">
                                <b>Status</b>
                                <span
                                    class="float-right badge
                                @if ($user->payment_status == 'paid') badge-success
                                @elseif($user->payment_status == 'verifying') badge-info
                                @else badge-secondary @endif">
                                    {{ ucfirst($user->payment_status) }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail User</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Membership Type</strong>
                                <p class="text-muted">
                                    {{ ucwords(str_replace('_', ' ', $user->membership_type)) }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <strong>Expired At</strong>
                                <p class="text-muted">
                                    @if ($user->expired_at)
                                        {{ \Carbon\Carbon::parse($user->expired_at)->format('d M Y') }}
                                        @if (now()->gt(\Carbon\Carbon::parse($user->expired_at)))
                                            <span class="badge badge-danger">Expired</span>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>

                        <hr>

                        <h4>Payment History</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($user->payments as $payment)
                                    <tr>
                                        <td>{{ $payment->created_at->format('d M Y') }}</td>
                                        <td>{{ ucwords(str_replace('_', ' ', $payment->payment_type)) }}</td>
                                        <td>Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                                        <td>
                                            <span
                                                class="badge
                                        @if ($payment->status == 'paid') badge-success
                                        @elseif($payment->status == 'verifying') badge-info
                                        @else badge-warning @endif">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No payment records</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
