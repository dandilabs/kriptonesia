@extends('frontend.index')

@section('title', 'Riwayat Pembayaran')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a></li>
                    <li class="breadcrumb-item active current">Riwayat Pembayaran</li>
                </ol>
            </nav>
        </div>

        <div class="title-wrapper">
            <h1>Riwayat Pembayaran</h1>
            <p>Daftar lengkap transaksi membership Anda</p>
        </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="payment-history-card">
            <div class="user-header" style="background: linear-gradient(45deg, #ff416c, #ff4b2b);">
                <div class="user-avatar">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div class="user-info">
                    <h3>{{ Auth::user()->name }}</h3>
                    <p>ID Member: {{ Auth::id() }}</p>
                </div>
            </div>

            <div class="payment-list">
                @forelse ($payments as $payment)
                    <div class="payment-item">
                        <div class="payment-main-info">
                            <div class="payment-type">
                                <i class="bi bi-credit-card" style="color: #ff4b2b;"></i>
                                <span>{{ ucwords(str_replace('_', ' ', $payment->payment_type)) }}</span>
                            </div>
                            <div class="payment-amount">
                                ${{ number_format($payment->amount / $usdRate, 2) }} USDT
                            </div>
                        </div>

                        <div class="payment-details">
                            <div class="detail-item">
                                <span>Tanggal:</span>
                                <strong>{{ $payment->created_at->format('d M Y H:i') }}</strong>
                            </div>

                            <div class="detail-item">
                                <span>Status:</span>
                                @if ($payment->status == 'verifying')
                                    <span class="status-badge" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                        <i class="bi bi-hourglass-split"></i> Sedang Diverifikasi
                                    </span>
                                @elseif($payment->status == 'pending')
                                    <span class="status-badge" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                        <i class="bi bi-clock-history"></i> Pending
                                    </span>
                                @elseif($payment->status == 'paid')
                                    <span class="status-badge" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                        <i class="bi bi-check-circle"></i> Lunas
                                    </span>
                                @else
                                    <span class="status-badge" style="background: rgba(220, 53, 69, 0.1); color: #dc3545;">
                                        <i class="bi bi-x-circle"></i> {{ ucfirst($payment->status) }}
                                    </span>
                                @endif
                            </div>

                            <div class="detail-item">
                                <span>Masa Berlaku:</span>
                                @if ($payment->expired_at)
                                    <strong>{{ $payment->expired_at->format('d M Y H:i') }}</strong>
                                    @if (now() > $payment->expired_at)
                                        <span class="status-badge"
                                            style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                            <i class="bi bi-exclamation-triangle"></i> Expired
                                        </span>
                                    @else
                                        <span class="status-badge"
                                            style="background: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                                            <i class="bi bi-check-circle"></i> {{ $payment->expired_at->diffForHumans() }}
                                        </span>
                                    @endif
                                @else
                                    <strong>-</strong>
                                @endif
                            </div>
                        </div>

                        <div class="payment-actions">
                            @if ($payment->status == 'pending')
                                <a href="{{ route('payment.confirm', ['user_id' => Auth::id(), 'payment_type' => $payment->payment_type]) }}"
                                    class="action-btn"
                                    style="background: linear-gradient(45deg, #ff416c, #ff4b2b); color: white;">
                                    <i class="bi bi-credit-card"></i> Bayar Sekarang
                                </a>
                            @elseif($payment->status == 'paid')
                                <span class="action-btn" style="background: rgba(255, 75, 43, 0.1); color: #ff4b2b;">
                                    <i class="bi bi-receipt"></i> Detail
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-wallet2" style="color: #ff4b2b;"></i>
                        <h4>Belum ada riwayat pembayaran</h4>
                        <p>Anda belum melakukan transaksi apapun</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        /* Payment History Styles */
        .payment-history-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(255, 75, 43, 0.1);
            overflow: hidden;
            margin-bottom: 50px;
        }

        .user-header {
            display: flex;
            align-items: center;
            padding: 25px;
            color: white;
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 2rem;
        }

        .user-info h3 {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .user-info p {
            opacity: 0.9;
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .payment-list {
            padding: 20px;
        }

        .payment-item {
            border: 1px solid rgba(255, 75, 43, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .payment-item:hover {
            border-color: rgba(255, 75, 43, 0.3);
            box-shadow: 0 5px 15px rgba(255, 75, 43, 0.1);
        }

        .payment-main-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 75, 43, 0.1);
        }

        .payment-type {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: #2c3e50;
        }

        .payment-type i {
            font-size: 1.2rem;
            margin-right: 10px;
        }

        .payment-amount {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .payment-details {
            margin-bottom: 15px;
        }

        .detail-item {
            display: flex;
            margin-bottom: 10px;
        }

        .detail-item span {
            width: 120px;
            color: #6c757d;
        }

        .detail-item strong {
            flex: 1;
            color: #2c3e50;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-badge i {
            margin-right: 5px;
            font-size: 0.9rem;
        }

        /* Action Buttons */
        .payment-actions {
            text-align: right;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 75, 43, 0.2);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .empty-state h4 {
            margin-bottom: 10px;
            color: #495057;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .user-header {
                padding: 20px;
                flex-direction: column;
                text-align: center;
            }

            .user-avatar {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .payment-main-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .payment-amount {
                margin-top: 10px;
            }

            .detail-item {
                flex-direction: column;
            }

            .detail-item span {
                width: auto;
                margin-bottom: 5px;
            }

            .payment-actions {
                text-align: center;
                margin-top: 15px;
            }
        }
    </style>
@endsection
