@extends('layouts.member')

@section('content')
    @include('sweetalert::alert')

    <style>
        /* Modern Countdown */
        .countdown-display {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .countdown-unit {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 70px;
        }

        .countdown-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #dc3545;
            line-height: 1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .countdown-label {
            font-size: 0.85rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        .countdown-expiry {
            background: rgba(220, 53, 69, 0.1);
            padding: 8px 12px;
            border-radius: 20px;
            display: inline-block;
            font-size: 0.9rem;
            color: #dc3545;
            font-weight: 500;
        }

        /* Card Improvements */
        .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: none;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            background: white;
            border-radius: 10px 10px 0 0 !important;
        }

        /* Fear & Greed Meter */
        .fear-greed-value {
            font-size: 5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ffc107, #fd7e14);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 10px 0;
        }

        .alert-expired {
            background: rgba(220, 53, 69, 0.15);
            border-left: 4px solid #dc3545;
            color: #dc3545;
            padding: 12px;
            border-radius: 4px;
        }
    </style>

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Member</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('member.home') }}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Status Section -->
            <div class="row">
                <!-- Membership Status Card -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header d-flex align-items-center">
                            <i class="fas fa-id-card mr-2"></i>
                            <h3 class="card-title mb-0">Status Membership</h3>
                        </div>
                        <div class="card-body">
                            @if (Auth::user()->payment_status === 'paid')
                                <div class="alert alert-success mb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle fa-2x mr-3"></i>
                                        <div>
                                            <h5 class="mb-1">AKTIF</h5>
                                            <p class="mb-1">Paket: <strong
                                                    class="text-uppercase">{{ str_replace('_', ' ', Auth::user()->membership_type) }}</strong>
                                            </p>
                                            <p class="mb-0">Berlaku hingga:
                                                <strong>{{ Auth::user()->expired_at ? Auth::user()->expired_at->format('d F Y') : '-' }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning mb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle fa-2x mr-3"></i>
                                        <div>
                                            <h5 class="mb-2">BELUM AKTIF</h5>
                                            <a href="{{ route('member.upgrade') }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-crown mr-1"></i> Upgrade Sekarang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Countdown Card -->
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-clock mr-2"></i> Masa Tenggang
                            </h3>
                        </div>
                        <div class="card-body text-center">
                            @php
                                $now = now();
                                $expiry = Auth::user()->expired_at;

                                // Pastikan expired_at valid
                                if ($expiry) {
                                    $diff = $now->diff($expiry);
                                    $daysLeft = $diff->d;
                                    $hoursLeft = $diff->h;
                                    $minutesLeft = $diff->i;
                                    $isExpired = $now > $expiry;
                                } else {
                                    $daysLeft = 0;
                                    $hoursLeft = 0;
                                    $minutesLeft = 0;
                                    $isExpired = true;
                                }
                            @endphp

                            @if ($isExpired)
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    Membership telah kadaluarsa
                                </div>
                            @else
                                <div class="countdown-display">
                                    @if ($daysLeft > 0)
                                        <div class="countdown-unit">
                                            <span class="countdown-number">{{ $daysLeft }}</span>
                                            <span class="countdown-label">HARI</span>
                                        </div>
                                    @endif

                                    <div class="countdown-unit">
                                        <span class="countdown-number">{{ $hoursLeft }}</span>
                                        <span class="countdown-label">JAM</span>
                                    </div>

                                    <div class="countdown-unit">
                                        <span class="countdown-number">{{ $minutesLeft }}</span>
                                        <span class="countdown-label">MENIT</span>
                                    </div>
                                </div>

                                <div class="countdown-expiry mt-2">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    Berakhir: {{ $expiry->format('d M Y H:i') }}
                                </div>

                                @if ($now->diffInHours($expiry) < 24 && Auth::user()->payment_status === 'paid')
                                    <div class="mt-3">
                                        <a href="{{ route('member.upgrade') }}" class="btn btn-danger btn-sm">
                                            <i class="fas fa-sync-alt mr-1"></i> Perpanjang Sekarang
                                        </a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="row mt-4">
                @if (str_contains(Auth::user()->membership_type, 'news'))
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-info shadow-sm">
                            <div class="inner">
                                <h3>News</h3>
                                <p>Berita Eksklusif</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <a href="{{ route('member.news') }}" class="small-box-footer">
                                Akses <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endif

                @if (str_contains(Auth::user()->membership_type, 'membership'))
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-gradient-indigo shadow-sm">
                            <div class="inner">
                                <h3>Signal</h3>
                                <p>Trading Signals</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <a href="{{ route('trade.index') }}" class="small-box-footer">
                                Lihat <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-gradient-purple shadow-sm">
                            <div class="inner">
                                <h3>VIP</h3>
                                <p>Komunitas Eksklusif</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="{{ route('member.community') }}" class="small-box-footer">
                                Gabung <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Fear & Greed Index -->
                <div class="col-md-6 mt-3">
                    <div class="card card-warning">
                        <div class="card-header d-flex align-items-center">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            <h3 class="card-title mb-0">Fear & Greed Index</h3>
                        </div>
                        <div class="card-body text-center py-4">
                            <div class="fear-greed-value">{{ $fearGreedValue }}</div>
                            <div class="badge badge-pill py-2 px-3"
                                style="background: #ffc107; color: #000; font-size: 1.1rem;">
                                {{ $fearGreedClassification }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
