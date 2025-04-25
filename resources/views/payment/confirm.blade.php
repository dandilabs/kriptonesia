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
            <p>Lengkapi proses pembayaran membership Anda</p>
        </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="payment-confirmation-card">
            <div class="payment-header">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div class="user-details">
                        <h3>{{ Auth::user()->name }}</h3>
                        <p>ID Member: {{ Auth::id() }}</p>
                    </div>
                </div>
            </div>

            <div class="payment-body">
                <div class="payment-details">
                    <h4><i class="bi bi-receipt me-2"></i>Detail Pembayaran</h4>
                    <div class="detail-item">
                        <span>Paket:</span>
                        <strong>{{ $product->name }}</strong>
                    </div>
                    <div class="detail-item">
                        <span>Harga Paket:</span>
                        <strong>${{ number_format($basePriceUsd, 2) }} USDT</strong>
                        <small class="text-muted">(Rp {{ number_format($basePrice) }})</small>
                    </div>
                    <div class="detail-item">
                        <span>Biaya Layanan (10%):</span>
                        <strong>${{ number_format($biayaLayananUsd, 2) }} USDT</strong>
                        <small class="text-muted">(Rp {{ number_format($biayaLayanan) }})</small>
                    </div>
                    <div class="detail-item total">
                        <span>Total Bayar:</span>
                        <strong class="total-amount">${{ number_format($totalBayarUsd, 2) }} USDT</strong>
                        <small class="text-muted">(Rp {{ number_format($totalBayar) }})</small>
                    </div>
                </div>

                <div class="payment-instruction">
                    <h4><i class="bi bi-wallet2 me-2"></i>Instruksi Pembayaran</h4>
                    <div class="instruction-box">
                        <div class="network-info">
                            <span>Jaringan:</span>
                            <strong> BSC (BEP20)</strong>
                        </div>
                        <div class="address-info">
                            <span>Alamat Wallet:</span>
                            <strong class="wallet-address">0x9a06d02e720879eea41779723698902f01cb3ec6</strong>
                            <button class="copy-btn" onclick="copyToClipboard()">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </div>
                        <div class="timer-info">
                            <span>Batas Waktu:</span>
                            <strong id="payment-timer" style="color: #ff4b2b;">00:30:00</strong>
                        </div>
                    </div>
                    <div class="note">
                        <i class="bi bi-info-circle"></i>
                        <p>Pastikan Anda mengirimkan tepat jumlah USDT yang tertera di atas. Transaksi yang tidak sesuai
                            akan diproses manual oleh admin.</p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert-message error">
                        <div class="alert-icon">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="alert-content">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('payment.confirm.process') }}" method="POST" enctype="multipart/form-data"
                    class="payment-form">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="payment_type" value="{{ $paymentType }}">
                    <input type="hidden" name="amount" value="{{ $totalBayar }}">

                    <div class="form-group">
                        <label for="proof" class="upload-label">
                            <i class="bi bi-cloud-arrow-up"></i>
                            <span>Unggah Bukti Transfer</span>
                            <p>Format: JPG, PNG (Maks. 2MB)</p>
                        </label>
                        <input type="file" name="proof" id="proof" required accept="image/*" class="upload-input">
                        <div class="preview-container" id="previewContainer"></div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="bi bi-send-fill me-2"></i>Kirim Konfirmasi
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Payment Confirmation Styles */
        .payment-confirmation-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 50px;
        }

        .payment-header {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            padding: 20px 30px;
            color: white;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
        }

        .user-details h3 {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .user-details p {
            opacity: 0.9;
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .payment-body {
            padding: 30px;
        }

        .payment-details,
        .payment-instruction {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 10px;
            background: #f9f9f9;
        }

        .payment-details h4,
        .payment-instruction h4 {
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-item.total {
            border-top: 2px solid #ff4b2b;
            margin-top: 10px;
            padding-top: 15px;
        }

        .total-amount {
            color: #ff4b2b;
            font-size: 1.2rem;
        }

        .instruction-box {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            border: 1px solid #eee;
        }

        .network-info,
        .address-info,
        .timer-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .address-info {
            position: relative;
        }

        .wallet-address {
            font-family: monospace;
            background: #f5f5f5;
            padding: 5px 10px;
            border-radius: 4px;
            margin: 0 10px;
            flex-grow: 1;
            overflow-wrap: break-word;
        }

        .copy-btn {
            background: #4e54c8;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .copy-btn:hover {
            background: #3a41b5;
            transform: scale(1.1);
        }

        .note {
            display: flex;
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            color: #1976d2;
        }

        .note i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .note p {
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        /* Form Styles */
        .payment-form {
            margin-top: 30px;
        }

        .upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            border: 2px dashed #ccc;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }

        .upload-label:hover {
            border-color: #4e54c8;
            background: #f8f9fa;
        }

        .upload-label i {
            font-size: 2rem;
            color: #4e54c8;
            margin-bottom: 10px;
        }

        .upload-label span {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .upload-label p {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 0;
        }

        .upload-input {
            display: none;
        }

        .preview-container {
            margin-top: 15px;
            text-align: center;
        }

        .preview-container img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 10px;
            border: 1px solid #eee;
        }

        /* Alert Message */
        .alert-message {
            display: flex;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-message.error {
            background: #ffebee;
            color: #c62828;
        }

        .alert-icon {
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .alert-content ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        /* Submit Button */
        .submit-btn {
            display: inline-block;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255, 75, 43, 0.3);
            width: 100%;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background: linear-gradient(45deg, #ff4b2b, #ff416c);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 75, 43, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {

            .payment-header,
            .payment-body {
                padding: 20px;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .detail-item,
            .network-info,
            .address-info,
            .timer-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .detail-item span,
            .network-info span,
            .address-info span,
            .timer-info span {
                margin-bottom: 5px;
            }

            .wallet-address {
                margin: 10px 0;
                width: 100%;
            }
        }
    </style>

    <script>
        // Countdown Timer
        function startTimer(duration, display) {
            let timer = duration,
                minutes, seconds;
            const interval = setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = "00:" + minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(interval);
                    display.textContent = "Waktu Habis";
                    display.style.color = "#c62828";
                }
            }, 1000);
        }

        window.onload = function() {
            const thirtyMinutes = 60 * 30;
            const display = document.querySelector('#payment-timer');
            startTimer(thirtyMinutes, display);
        };

        // Copy to Clipboard
        function copyToClipboard() {
            const address = document.querySelector('.wallet-address');
            navigator.clipboard.writeText(address.textContent.trim());

            const btn = document.querySelector('.copy-btn');
            btn.innerHTML = '<i class="bi bi-check"></i>';
            btn.style.background = '#4caf50';

            setTimeout(() => {
                btn.innerHTML = '<i class="bi bi-clipboard"></i>';
                btn.style.background = '#4e54c8';
            }, 2000);
        }

        // Image Preview
        const input = document.getElementById('proof');
        const previewContainer = document.getElementById('previewContainer');

        input.addEventListener('change', function() {
            previewContainer.innerHTML = '';

            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    previewContainer.appendChild(img);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endsection
