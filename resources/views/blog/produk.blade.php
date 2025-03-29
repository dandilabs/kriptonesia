@extends('frontend.index')

@section('title', 'Produk')

@section('content')
    <style>
        /* Pricing Section */
        .pricing-section {
            padding: 80px 0;
        }

        .pricing-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            height: 100%;
            transition: transform 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .pricing-card.premium {
            border-top: 4px solid #ff4b2b;
        }

        .pricing-header {
            padding: 30px;
            text-align: center;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            position: relative;
        }

        .pricing-header h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .price {
            margin-bottom: 15px;
        }

        .price .amount {
            font-size: 42px;
            font-weight: 700;
            color: #333;
        }

        .price .currency {
            font-size: 24px;
            vertical-align: top;
            margin-right: 2px;
        }

        .price .period {
            font-size: 16px;
            color: #6c757d;
        }

        .badge {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 10px;
            border-radius: 50px;
        }

        .pricing-features {
            padding: 30px;
        }

        .pricing-features ul {
            list-style: none;
            padding: 0;
        }

        .pricing-features li {
            padding: 8px 0;
            display: flex;
            align-items: center;
        }

        .pricing-features i {
            margin-right: 10px;
            font-size: 18px;
        }

        .pricing-footer {
            padding: 0 30px 30px;
        }

        .btn-warning {
            background: linear-gradient(45deg, #ff9a00, #ff4b2b);
            color: white;
            border: none;
            font-weight: 600;
        }

        .btn-warning:hover {
            background: linear-gradient(45deg, #ff8a00, #ff3b1b);
            color: white;
        }

        /* Feature Comparison */
        .feature-comparison {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .feature-comparison table {
            margin-bottom: 0;
        }

        .feature-comparison th {
            font-weight: 600;
            background: #f8f9fa;
        }

        .feature-comparison td {
            padding: 12px 15px;
        }

        .feature-comparison tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .pricing-card {
                margin-bottom: 30px;
            }

            .price .amount {
                font-size: 36px;
            }
        }
    </style>
    <!-- Page Title -->
    <div class="page-title">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a></li>
                    <li class="breadcrumb-item active current">Produk</li>
                </ol>
            </nav>
        </div>

        <div class="title-wrapper">
            <h1>Paket Membership</h1>
            <p>Pilih paket yang sesuai dengan kebutuhan trading cryptocurrency Anda</p>
        </div>
    </div><!-- End Page Title -->

    <!-- Pricing Section -->
    <section class="pricing-section section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="mb-3">💡 Tingkatkan Strategi Trading Anda</h2>
                <p class="text-muted">Dapatkan akses eksklusif ke analisis pasar, sinyal trading, dan komunitas VIP kami</p>
            </div>

            <div class="row gy-4 justify-content-center">
                <!-- News Package -->
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <h3>Paket News</h3>
                            <div class="price">
                                <span class="currency">Rp</span>
                                <span class="amount">99.000</span>
                                <span class="period">/bulan</span>
                            </div>
                            <div class="badge bg-warning text-dark">🔥 Populer</div>
                        </div>
                        <div class="pricing-features">
                            <ul>
                                <li><i class="bi bi-check-circle-fill text-success"></i> Akses Berita Eksklusif</li>
                                <li><i class="bi bi-check-circle-fill text-success"></i> Data Sentimen Pasar</li>
                                <li><i class="bi bi-check-circle-fill text-success"></i> Info Airdrop Terkini</li>
                                <li><i class="bi bi-x-circle-fill text-muted"></i> Strategi Trading</li>
                                <li><i class="bi bi-x-circle-fill text-muted"></i> Sinyal Trading</li>
                                <li><i class="bi bi-x-circle-fill text-muted"></i> Komunitas VIP</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="#" class="btn btn-warning btn-lg w-100 py-3">
                                <i class="bi bi-lightning-fill me-2"></i>Pilih Paket Ini
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Full Access Package -->
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="pricing-card premium">
                        <div class="pricing-header">
                            <h3>Paket Full Akses</h3>
                            <div class="price">
                                <span class="currency">Rp</span>
                                <span class="amount">299.000</span>
                                <span class="period">/bulan</span>
                            </div>
                            <div class="badge bg-danger">🚀 Best Value</div>
                        </div>
                        <div class="pricing-features">
                            <ul>
                                <li><i class="bi bi-check-circle-fill text-success"></i> Semua Fitur Paket News</li>
                                <li><i class="bi bi-check-circle-fill text-success"></i> Strategi Trading Lengkap</li>
                                <li><i class="bi bi-check-circle-fill text-success"></i> Sinyal Trading Harian</li>
                                <li><i class="bi bi-check-circle-fill text-success"></i> Analisis On-Chain</li>
                                <li><i class="bi bi-check-circle-fill text-success"></i> Panduan Eksklusif</li>
                                <li><i class="bi bi-check-circle-fill text-success"></i> Komunitas VIP</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="#" class="btn btn-danger btn-lg w-100 py-3">
                                <i class="bi bi-rocket me-2"></i>Pilih Paket Premium
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature Comparison -->
            <div class="feature-comparison mt-5" data-aos="fade-up" data-aos-delay="300">
                <h4 class="text-center mb-4">Perbandingan Fitur Lengkap</h4>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Fitur</th>
                                <th class="text-center">News</th>
                                <th class="text-center">Full Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Analisis Pasar Harian</td>
                                <td class="text-center"><i class="bi bi-check-lg text-success"></i></td>
                                <td class="text-center"><i class="bi bi-check-lg text-success"></i></td>
                            </tr>
                            <tr>
                                <td>Sinyal Trading Real-time</td>
                                <td class="text-center"><i class="bi bi-x-lg text-muted"></i></td>
                                <td class="text-center"><i class="bi bi-check-lg text-success"></i></td>
                            </tr>
                            <tr>
                                <td>Konsultasi Privat</td>
                                <td class="text-center"><i class="bi bi-x-lg text-muted"></i></td>
                                <td class="text-center"><i class="bi bi-check-lg text-success"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section><!-- End Pricing Section -->

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
