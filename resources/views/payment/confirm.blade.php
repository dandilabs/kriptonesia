@extends('frontend.index')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a></li>
                    <li class="breadcrumb-item active current">Konfirmasi Pembayaran</li>
                </ol>
            </nav>
        </div>

        <div class="title-wrapper">
            <h1>Konfirmasi Pembayaran</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Detail Pembayaran - {{ Auth::user()->name }}</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Detail Pembayaran</h5>
                <p><strong>Jenis Layanan:</strong> {{ ucfirst($paymentType) }}</p>
                {{-- <p><strong>Jumlah yang harus dibayar:</strong> Rp{{ number_format($amount, 0, ',', '.') }}</p> --}}
                <p><strong>Biaya Layanan:</strong> {{ number_format($biayaLayananUsd, 2) }} USDT </p>
                <p><strong>Pajak (10%):</strong> {{ number_format($pajakUsd, 2) }} USDT</p>
                {{-- <p><strong>Total Bayar (IDR):</strong> Rp{{ number_format($totalBayar, 0, ',', '.') }}</p> --}}
                {{-- <p><strong>Kurs USDT saat ini:</strong> Rp{{ number_format($usdRate, 0, ',', '.') }}</p> --}}
                <p><strong>Total Bayar dalam USDT:</strong> {{ number_format($totalBayarUsd, 2) }} USDT</p>


                <hr>
                <h5>Alamat USDT:</h5>
                <p><strong>Jaringan:</strong> BSC (BEP20)</p>
                <p><strong>Alamat:</strong> 0x9a06d02e720879eea41779723698902f01cb3ec6</p>
                <p id="payment-timer" style="color: red; font-weight: bold;"></p>
                {{-- <p><strong>Atas Nama:</strong> PT. Crypto Indonesia</p> --}}
                <hr>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('payment.confirm.process') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="payment_type" value="{{ $paymentType }}">
                    <input type="hidden" name="amount" value="{{ $totalBayar }}">
                    <div class="form-group">
                        <label for="proof">Unggah Bukti Transfer</label>
                        <input type="file" class="form-control" name="proof" id="proof" required accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
