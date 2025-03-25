@extends('template.index')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content text-center">
                    <h1>Konfirmasi Pembayaran</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Konfirmasi Pembayaran</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Detail Pembayaran</h3>
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
                        <input type="file" class="form-control" name="proof" id="proof" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    // Timer 5 menit
    let timeLeft = 300; // 5 menit dalam detik
    const timerDisplay = document.getElementById('payment-timer');

    function updateTimer() {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;
        timerDisplay.innerHTML = `Selesaikan pembayaran dalam ${minutes}:${seconds < 10 ? '0' : ''}${seconds} menit`;
        if (timeLeft > 0) {
            timeLeft--;
            setTimeout(updateTimer, 1000);
        } else {
            // Jika waktu habis, redirect ke halaman transaksi sebelumnya
            window.location.href = "{{ route('payment.history') }}";
        }
    }

    updateTimer();
</script>
