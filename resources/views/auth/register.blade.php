@extends('template.index')

@section('title')
    Daftar Akun
@endsection

@section('content')
<section class="mb-30px">
    <div class="container">
        <div class="hero-banner hero-banner--sm">
            <div class="hero-banner__content">
                <h1>Daftar Akun</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Daftar Akun</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Konfirmasi Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="membership" class="col-md-4 col-form-label text-md-end">Pilih Paket</label>
                            <div class="col-md-6">
                                <select id="membership" class="form-control" name="membership_type">
                                    <option value="free">Hanya Daftar</option>
                                    <optgroup label="Langganan News">
                                        <option value="news_1hari">News - 1 Hari (Rp5.000)</option>
                                        <option value="news_1bulan">News - 1 Bulan (Rp50.000)</option>
                                        <option value="news_3bulan">News - 3 Bulan (Rp120.000)</option>
                                        <option value="news_6bulan">News - 6 Bulan (Rp200.000)</option>
                                        <option value="news_lifetime">News - Lifetime (Rp500.000)</option>
                                    </optgroup>
                                    <optgroup label="Membership Full Akses">
                                        <option value="membership_1bulan">1 Bulan - Rp250.000</option>
                                        <option value="membership_3bulan">3 Bulan - Rp500.000</option>
                                        <option value="membership_6bulan">6 Bulan - Rp1.500.000</option>
                                        <option value="membership_lifetime">Lifetime - Rp3.000.000</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="button button--active button-contactForm">
                                    Daftar Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
