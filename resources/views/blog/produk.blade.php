@extends('frontend.index')

@section('title', 'Paket Membership')

@section('content')
    <style>
        /* CoinGlass Style Pricing */
        .pricing-section {
            padding: 60px 0;
            background-color: #f8f9fa;
        }

        .pricing-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .pricing-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e2022;
            margin-bottom: 15px;
        }

        .pricing-header p {
            font-size: 1.1rem;
            color: #6c757d;
            max-width: 700px;
            margin: 0 auto;
        }

        .pricing-cards {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
        }

        .pricing-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 350px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .pricing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .pricing-card.popular {
            border-top: 4px solid #ff4b2b;
            position: relative;
            transform: scale(1.05);
        }

        .pricing-card-header {
            padding: 25px;
            text-align: center;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .pricing-card.popular .pricing-card-header {
            background: linear-gradient(135deg, #fff8f8 0%, #ffffff 100%);
        }

        .pricing-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #1e2022;
        }

        .pricing-card-price {
            margin-bottom: 5px;
        }

        .pricing-card-price .amount {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e2022;
        }

        .pricing-card-price .currency {
            font-size: 1.5rem;
            vertical-align: top;
            margin-right: 2px;
        }

        .pricing-card-price .period {
            font-size: 1rem;
            color: #6c757d;
        }

        .pricing-card-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 5px 10px;
            border-radius: 50px;
            background: #ff4b2b;
            color: white;
        }

        .pricing-card-features {
            padding: 25px;
        }

        .pricing-card-features ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pricing-card-features li {
            padding: 10px 0;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .pricing-card-features li:last-child {
            border-bottom: none;
        }

        .pricing-card-features i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .pricing-card-features .bi-check-circle-fill {
            color: #28a745;
        }

        .pricing-card-features .bi-x-circle-fill {
            color: #dc3545;
        }

        .pricing-card-footer {
            padding: 0 25px 25px;
            text-align: center;
        }

        .btn-pricing {
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-pricing-primary {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: white;
            border: none;
        }

        .btn-pricing-primary:hover {
            background: linear-gradient(45deg, #ff4b2b, #ff416c);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 75, 43, 0.3);
        }

        .btn-pricing-outline {
            background: white;
            color: #ff4b2b;
            border: 2px solid #ff4b2b;
        }

        .btn-pricing-outline:hover {
            background: #ff4b2b;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .pricing-cards {
                flex-direction: column;
                align-items: center;
            }

            .pricing-card {
                max-width: 100%;
            }

            .pricing-card.popular {
                transform: scale(1);
            }
        }
    </style>

    <!-- Page Title -->
    <div class="page-title">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a></li>
                    <li class="breadcrumb-item active current">Paket Membership</li>
                </ol>
            </nav>
        </div>
        <div class="title-wrapper">
            <h1>Paket Membership</h1>
            <p>Pilih paket yang sesuai dengan kebutuhan trading cryptocurrency Anda</p>
        </div>
    </div>

    <!-- Pricing Section -->
    <section class="pricing-section">
        <div class="container">
            <div class="pricing-header">
                <h2>Pilih Paket Yang Tepat Untuk Anda</h2>
                <p>Dapatkan akses eksklusif ke analisis pasar, sinyal trading, dan komunitas VIP kami</p>
            </div>

            <div class="pricing-cards">
                @foreach ($products as $type => $group)
                    @foreach ($group as $product)
                        <div class="pricing-card {{ $product->is_popular ? 'popular' : '' }}">
                            @if ($product->is_popular)
                                <span class="pricing-card-badge">POPULAR</span>
                            @endif

                            <div class="pricing-card-header">
                                <h3 class="pricing-card-title">{{ $product->name }}</h3>
                                <div class="pricing-card-price">
                                    <span class="currency">$</span>
                                    <span class="amount">{{ number_format($product->price_usd, 2) }}</span>
                                    @if ($product->duration)
                                        <span class="period">/{{ $product->duration }} bulan</span>
                                    @else
                                        <span class="period">/Lifetime</span>
                                    @endif
                                </div>
                                <small class="text-muted">≈ Rp {{ number_format($product->price) }}</small>
                            </div>

                            <div class="pricing-card-features">
                                <ul>
                                    @foreach (json_decode($product->features) as $feature)
                                        <li><i class="bi bi-check-circle-fill"></i> {{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="pricing-card-footer">
                                @auth
                                    <form action="{{ route('member.upgrade.process') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit"
                                            class="btn-pricing {{ $product->is_popular ? 'btn-pricing-primary' : 'btn-pricing-outline' }}">
                                            <i class="bi bi-lightning-fill me-2"></i>
                                            {{ auth()->user()->membership_type === $product->code ? 'Paket Aktif' : 'Pilih Paket' }}
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="btn-pricing {{ $product->is_popular ? 'btn-pricing-primary' : 'btn-pricing-outline' }}">
                                        <i class="bi bi-lightning-fill me-2"></i>Login untuk Berlangganan
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section bg-light">
        <div class="container text-center py-5">
            <h3 class="mb-4">Masih ragu memilih paket?</h3>
            <p class="mb-4">Konsultasikan kebutuhan trading Anda dengan tim ahli kami</p>
            <a href="{{ url('/kontak') }}" class="btn btn-outline-primary btn-lg px-4">
                <i class="bi bi-headset me-2"></i>Hubungi Kami
            </a>
        </div>
    </section>
@endsection
