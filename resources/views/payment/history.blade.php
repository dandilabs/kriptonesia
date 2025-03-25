@extends('template.index')

@section('title', 'Riwayat Pembayaran')

@section('content')
<section class="mb-30px">
    <div class="container">
        <div class="hero-banner hero-banner--sm">
            <div class="hero-banner__content text-center">
                <h1>Riwayat Pembayaran</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Pembayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
    <div class="container">
        <h3>Riwayat Pembayaran</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal Daftar</th>
                    <th>Jenis Layanan</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Masa Berlaku</th> <!-- Tambah kolom baru -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->created_at->format('d M Y H:i') }}</td>
                        <td>{{ ucfirst($payment->payment_type) }}</td>
                        <td>Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($payment->status) }}</td>
                        <td>
                            @if($payment->expired_at)
                                {{ $payment->expired_at->format('d M Y H:i') }}
                                @if(now() > $payment->expired_at)
                                    <span class="badge badge-danger">Expired</span>
                                @else
                                    <span class="badge badge-success">
                                        {{ $payment->expired_at->diffForHumans() }}
                                    </span>
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($payment->status == 'pending')
                                <a href="{{ route('payment.confirm', ['user_id' => Auth::id(), 'payment_type' => $payment->payment_type]) }}"
                                    class="btn btn-primary">Lanjutkan Pembayaran</a>
                            @elseif ($payment->status == 'paid')
                                <span class="badge badge-success">Lunas</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
