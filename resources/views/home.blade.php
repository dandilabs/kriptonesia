@extends('layouts.admin')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info Boxes -->
            <div class="row">
                <!-- Total Users -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalUsers ?? 0 }}</h3>
                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('user.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Posts -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalPosts ?? 0 }}</h3>
                            <p>Total Postingan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <a href="{{ route('post.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- New Registrations -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $newUsers ?? 0 }}</h3>
                            <p>Pendaftaran Baru (30hr)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="{{ route('user.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Rp{{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h3>
                            <p>Total Keuntungan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <a href="{{ route('admin.payments') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Welcome Card -->
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Selamat Datang, {{ Auth::user()->name }}</h3>
                        </div>
                        <div class="card-body text-center">
                            <p class="mb-0">Sistem Manajemen Kriptonesia</p>
                            <p class="text-muted">Terakhir login:
                                {{ Auth::user()->last_login_at?->format('d M Y H:i') ?? 'Belum pernah' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .small-box {
            border-radius: .25rem;
            box-shadow: 0 0 1px rgba(0, 0, 0, .1), 0 2px 4px rgba(0, 0, 0, .1);
            transition: all 0.3s ease;
        }

        .small-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, .15);
        }

        .small-box .icon {
            font-size: 70px;
            opacity: 0.3;
            transition: all 0.3s linear;
        }

        .small-box:hover .icon {
            opacity: 0.4;
            transform: scale(1.05);
        }
    </style>
@endpush
