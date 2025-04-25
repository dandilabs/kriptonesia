@extends('layouts.admin')
@section('title', 'User Details')
@section('content')

<style>
    .profile-header {
        position: relative;
        overflow: hidden;
        border-radius: 0.35rem 0.35rem 0 0;
        background: linear-gradient(135deg, #6777ef 0%, #6777ef 100%);
        padding: 2rem;
        color: white;
        text-align: center;
    }

    .profile-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid rgba(255,255,255,0.3);
        object-fit: cover;
    }

    .profile-name {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 1rem;
    }

    .profile-email {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .info-card {
        border-left: 4px solid #6777ef;
        border-radius: 0.25rem;
    }

    .info-label {
        font-size: 0.8rem;
        color: #6c757d;
        text-transform: uppercase;
        font-weight: 600;
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .payment-table th {
        background-color: #f8f9fa !important;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="profile-header">
                        <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="profile-img" alt="User Image">
                        <h3 class="profile-name">{{ $user->name }}</h3>
                        <p class="profile-email">{{ $user->email }}</p>

                        @if ($user->email_verified_at)
                        <span class="badge badge-success">
                            <i class="fas fa-check-circle"></i> Verified
                        </span>
                        @else
                        <span class="badge badge-warning">
                            <i class="fas fa-exclamation-circle"></i> Unverified
                        </span>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="mb-4">
                            <div class="info-label">REGISTRATION DATE</div>
                            <div class="info-value">
                                {{ $user->created_at->format('d M Y') }}
                                <small class="text-muted d-block">({{ $user->created_at->diffForHumans() }})</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="info-label">ACCOUNT STATUS</div>
                            <div class="info-value">
                                @if ($user->payment_status == 'paid')
                                <span class="badge badge-success">Active</span>
                                @elseif($user->payment_status == 'verifying')
                                <span class="badge badge-info">Verifying</span>
                                @else
                                <span class="badge badge-secondary">Free</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="info-label">USER ROLE</div>
                            <div class="info-value">
                                @if ($user->role == 1)
                                <span class="badge badge-danger">Administrator</span>
                                @else
                                <span class="badge badge-warning">Regular User</span>
                                @endif
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm mr-2">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>
                            <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#resetPasswordModal">
                                <i class="fas fa-key"></i> Reset Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-id-card mr-1"></i>
                            Membership Information
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-card p-3 mb-3">
                                    <div class="info-label">MEMBERSHIP TYPE</div>
                                    <div class="info-value">
                                        <span class="badge
                                            @if(str_contains($user->membership_type, 'lifetime')) badge-primary
                                            @elseif(str_contains($user->membership_type, 'news')) badge-info
                                            @else badge-success @endif">
                                            {{ ucwords(str_replace('_', ' ', $user->membership_type)) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card p-3 mb-3">
                                    <div class="info-label">EXPIRY DATE</div>
                                    <div class="info-value">
                                        @if ($user->expired_at)
                                            {{ \Carbon\Carbon::parse($user->expired_at)->format('d M Y') }}
                                            @if(now() > \Carbon\Carbon::parse($user->expired_at))
                                                <span class="badge badge-danger ml-2">Expired</span>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h5 class="mb-3">
                            <i class="fas fa-credit-card mr-1"></i>
                            Payment History
                        </h5>

                        @if($user->payments->count() > 0)
                        <div class="table-responsive">
                            <table class="table payment-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Receipt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->payments as $payment)
                                    <tr>
                                        <td>{{ $payment->created_at->format('d M Y') }}</td>
                                        <td>{{ ucwords(str_replace('_', ' ', $payment->payment_type)) }}</td>
                                        <td>Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge
                                                @if($payment->status == 'paid') badge-success
                                                @elseif($payment->status == 'verifying') badge-info
                                                @else badge-warning @endif">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($payment->receipt_url)
                                            <a href="{{ $payment->receipt_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                View
                                            </a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-info">
                            No payment records found for this user.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="#">
                @csrf
                <div class="modal-body">
                    <p>Are you sure you want to reset password for <strong>{{ $user->name }}</strong>?</p>
                    <p>A temporary password will be generated and sent to the user's email.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
