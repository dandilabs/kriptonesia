@extends('template.index')

@section('title', 'Upgrade Membership')

@section('content')
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content text-center">
                    <h1>Mulai Berlangganan</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mulai Berlangganan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Mulai berlangganan - {{ Auth::user()->name }}</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('member.upgrade.process') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="membership">Pilih Paket Membership</label>
                        <select id="membership" class="form-control" name="membership_type">
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
                    <button type="submit" class="btn btn-primary">Pilih dan Bayar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
