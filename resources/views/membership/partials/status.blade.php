@extends('layouts.member')
@section('content')
@include('sweetalert::alert')
<div class="row mb-3">
    <!-- Status Langganan -->
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-id-card"></i> Status Membership
                </h3>
            </div>
            <div class="card-body">
                @if (Auth::user()->payment_status === 'paid')
                    <div class="alert alert-success">
                        <h5><i class="fas fa-check-circle"></i> Aktif</h5>
                        <p class="mb-1">Paket:
                            <strong>{{ ucwords(str_replace('_', ' ', Auth::user()->membership_type)) }}</strong></p>
                        <p class="mb-0">Berlaku hingga:
                            <strong>{{ Auth::user()->expired_at->format('d F Y') }}</strong></p>
                    </div>

                    <div class="progress-group">
                        Masa Aktif
                        <span class="float-right"><b>{{ $daysLeft }}</b>/{{ $totalDays }} hari</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <h5><i class="fas fa-exclamation-triangle"></i> Tidak Aktif</h5>
                        <p>Anda belum memiliki membership aktif</p>
                        <a href="{{ route('member.upgrade') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-crown"></i> Upgrade Sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Countdown Expired -->
    <div class="col-md-6">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-clock"></i> Masa Tenggang
                </h3>
            </div>
            <div class="card-body text-center">
                <h3 class="countdown-display">{{ $daysLeft }}</h3>
                <p class="mb-0">HARI LAGI</p>
                <small>Berakhir: {{ Auth::user()->expired_at->format('d M Y') }}</small>

                @if ($daysLeft < 7)
                    <div class="mt-3">
                        <a href="{{ route('member.upgrade') }}" class="btn btn-danger">
                            <i class="fas fa-sync-alt"></i> Perpanjang Sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
