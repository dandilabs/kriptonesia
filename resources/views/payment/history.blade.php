@extends('template.index')

@section('title', 'Riwayat Pembayaran')

@section('content')
    <style>
        .badge {
            font-size: 0.85em;
            padding: 0.35em 0.65em;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }
    </style>
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
                    <th>Tanggal</th>
                    <th>Jenis Layanan</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Masa Berlaku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ $payment->created_at->format('d M Y H:i') }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $payment->payment_type)) }}</td>
                        <td>${{ number_format($payment->amount / $usdRate, 2) }} USDT</td>
                        <td>
                            @if ($payment->status == 'verifying')
                                <span class="badge badge-info">Sedang Diverifikasi</span>
                            @elseif($payment->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($payment->status == 'paid')
                                <span class="badge badge-success">Lunas</span>
                            @else
                                <span class="badge badge-danger">{{ ucfirst($payment->status) }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($payment->expired_at)
                                {{ $payment->expired_at->format('d M Y H:i') }}
                                @if (now() > $payment->expired_at)
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
                                    class="btn btn-sm btn-primary">Bayar</a>
                            @elseif($payment->status == 'paid')
                                <span class="text-success"><i class="fas fa-check-circle"></i></span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada riwayat pembayaran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
