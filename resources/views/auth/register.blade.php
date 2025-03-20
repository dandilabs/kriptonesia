@extends('template.index')

@section('title')
    Membership
@endsection

@section('content')
<section class="mb-30px">
    <div class="container">
        <div class="hero-banner hero-banner--sm">
            <div class="hero-banner__content">
                <h1>Membership</h1>
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
                <div class="card-header">{{ __('Daftar membership') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Konfirmasi Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="membership" class="col-md-4 col-form-label text-md-end">Pilih Membership</label>
                            <div class="col-md-6">
                                <select id="membership" class="form-control" name="membership_type" required>
                                    <option value="1_bulan">1 Bulan - Rp250.000</option>
                                    <option value="3_bulan">3 Bulan - Rp500.000</option>
                                    <option value="6_bulan">6 Bulan - Rp1.500.000</option>
                                    <option value="lifetime">Lifetime - Rp3.000.000</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" id="pay-button" class="button button--active button-contactForm">
                                    Bayar Sekarang
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

@push('js')

<script>
    document.getElementById('pay-button').onclick = function () {
    let membership = document.getElementById('membership').value;
    let price = membership === "1_bulan" ? 250000 :
                membership === "3_bulan" ? 500000 :
                membership === "6_bulan" ? 1500000 : 3000000;

    fetch("{{ route('payment.create') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            membership_type: membership,
            price: price // Harga tanpa biaya layanan
        })
    })
    .then(response => response.json())
    .then(data => {
        snap.pay(data.snap_token, {
            onSuccess: function(result) {
                alert('Pembayaran sukses!');
                window.location.href = "{{ url('/membership/success') }}";
            },
            onPending: function(result) {
                alert('Menunggu pembayaran...');
            },
            onError: function(result) {
                alert('Pembayaran gagal!');
            }
        });
    });
};
</script>
@endpush
