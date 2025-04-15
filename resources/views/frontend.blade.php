@extends('frontend.index')
@section('title')
    Beranda
@endsection

@section('content')
@include('sweetalert::alert')
    <style>
        /* Crypto CTA Section */
        .crypto-cta {
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .crypto-offer {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .badge {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: white;
            padding: 8px 15px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 12px;
            display: inline-block;
        }

        .feature-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 15px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-warning {
            background: linear-gradient(45deg, #ff9a00, #ff4b2b);
            color: white;
            border: none;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .btn-warning:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 155, 0, 0.3);
        }

        .btn-outline-primary {
            border: 2px solid #4e54c8;
            color: #4e54c8;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .btn-outline-primary:hover {
            background: #4e54c8;
            color: white;
        }

        .floating-card {
            position: absolute;
            bottom: -20px;
            right: -20px;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
            width: 150px;
        }

        .card-icon {
            font-size: 24px;
        }

        .stats-number {
            font-size: 24px;
            font-weight: 700;
            display: block;
            line-height: 1;
        }

        .stats-text {
            font-size: 12px;
            opacity: 0.8;
        }

        .decoration {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: -1;
        }

        .circle-1,
        .circle-2 {
            position: absolute;
            border-radius: 50%;
            background: rgba(78, 84, 200, 0.1);
        }

        .circle-1 {
            width: 200px;
            height: 200px;
            top: -50px;
            right: -50px;
        }

        .circle-2 {
            width: 300px;
            height: 300px;
            bottom: -100px;
            left: -100px;
        }
    </style>
    <!-- Blog Hero Section -->
    <section id="blog-hero" class="blog-hero section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="blog-grid">

                @foreach ($data as $key => $item)
                    <!-- Jika item pertama, tampilkan sebagai Featured Post -->
                    @if ($key === 0)
                        <article class="blog-item featured" data-aos="fade-up">
                            <img src="{{ asset($item->image) }}" alt="{{ $item->judul }}" class="img-fluid">
                            <div class="blog-content">
                                <div class="post-meta">
                                    <span
                                        class="date">{{ \Carbon\Carbon::parse($item->created_at)->format('M. d, Y') }}</span>
                                    <span class="category">{{ $item->category->name ?? 'Uncategorized' }}</span>
                                </div>
                                <h2 class="post-title">
                                    <a href="{{ route('blog.isi', $item->slug) }}" title="{{ $item->judul }}">
                                        {{ $item->judul }}
                                    </a>
                                </h2>
                            </div>
                        </article><!-- End Featured Post -->
                    @else
                        <!-- Regular Posts -->
                        <article class="blog-item" data-aos="fade-up" data-aos-delay="{{ 100 * $key }}">
                            <img src="{{ asset($item->image) }}" alt="{{ $item->judul }}" class="img-fluid">
                            <div class="blog-content">
                                <div class="post-meta">
                                    <span
                                        class="date">{{ \Carbon\Carbon::parse($item->created_at)->format('M. d, Y') }}</span>
                                    <span class="category">{{ $item->category->name ?? 'Uncategorized' }}</span>
                                </div>
                                <h3 class="post-title">
                                    <a href="{{ route('blog.isi', $item->slug) }}" title="{{ $item->judul }}">
                                        {{ $item->judul }}
                                    </a>
                                </h3>
                            </div>
                        </article><!-- End Blog Item -->
                    @endif
                @endforeach

            </div>
        </div>
    </section><!-- /Blog Hero Section -->

    <!-- Featured Posts Section -->
    <section id="featured-posts" class="featured-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Populer</h2>
            <div><span>Lihat</span> <span class="description-title">Postingan Populer</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="blog-posts-slider swiper init-swiper">
                <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 800,
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": 3,
                "spaceBetween": 30,
                "breakpoints": {
                  "320": {
                    "slidesPerView": 1,
                    "spaceBetween": 20
                  },
                  "768": {
                    "slidesPerView": 2,
                    "spaceBetween": 20
                  },
                  "1200": {
                    "slidesPerView": 3,
                    "spaceBetween": 30
                  }
                }
              }
            </script>

                <div class="swiper-wrapper">
                    @if ($popular_posts->isEmpty())
                        <p>Tidak ada postingan populer.</p>
                    @else
                        @foreach ($popular_posts as $post)
                            <div class="swiper-slide">
                                <div class="blog-post-item">
                                    <img src="{{ asset($post->image) }}" alt="Blog Image">
                                    <div class="blog-post-content">
                                        <div class="post-meta">
                                            <span><i class="bi bi-person"></i> {{ $post->users->name }}</span>
                                            <span><i class="bi bi-clock"></i>
                                                {{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }}</span>
                                            {{-- <span><i class="bi bi-chat-dots"></i> 6 Comments</span> --}}
                                        </div>
                                        <h2><a
                                                href="{{ route('blog.isi', $post->slug) }}">{{ Str::limit($post->judul, 50) }}</a>
                                        </h2>
                                        {{-- <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Fusce porttitor metus eget lectus consequat, sit amet feugiat magna vulputate.</p> --}}
                                        <a href="{{ route('blog.isi', $post->slug) }}" class="read-more">Read More <i
                                                class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div><!-- End slide item -->
                        @endforeach
                    @endif
                </div>

            </div>

        </div>

    </section><!-- /Featured Posts Section -->

    <!-- Category Section Section -->
    <section id="category-section" class="category-section section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kategori</h2>
            <div> <span class="description-title">Postingan Kategori</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Featured Posts -->
            <div class="row gy-4 mb-4">
                @foreach ($featured_posts as $post)
                    <div class="col-lg-4">
                        <article class="featured-post">
                            <div class="post-img">
                                <img src="{{ asset($post->image) }}" alt="" class="img-fluid" loading="lazy">
                            </div>
                            <div class="post-content">
                                <div class="category-meta">
                                    <span class="post-category">{{ $post->category->name }}</span>
                                    <div class="author-meta">
                                        {{-- <img src="{{ asset($post->users->image ?? 'default-avatar.jpg') }}" alt="" class="author-img"> --}}
                                        <span class="author-name">{{ $post->users->name }}</span>
                                        <span
                                            class="post-date">{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <h2 class="title">
                                    <a href="{{ route('blog.isi', $post->slug) }}">{{ $post->judul }}</a>
                                </h2>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <!-- List Posts -->
            <div class="row">
                @foreach ($categories as $category)
                    {{-- @if ($category->posts->isNotEmpty()) --}}
                    @foreach ($category->posts as $post)
                        <div class="col-xl-4 col-lg-6">
                            <article class="list-post">
                                <div class="post-img">
                                    <img src="{{ asset($post->image) }}" alt="" class="img-fluid" loading="lazy">
                                </div>
                                <div class="post-content">
                                    <div class="category-meta">
                                        <span class="post-category">{{ $post->category->name }}</span>
                                    </div>
                                    <h3 class="title">
                                        <a href="{{ route('blog.isi', $post->slug) }}">{{ $post->judul }}</a>
                                    </h3>
                                    <div class="post-meta">
                                        <span class="read-time">2 mins read</span>
                                        <span
                                            class="post-date">{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                    {{-- @else
                        <p>Belum ada post di kategori ini.</p>
                    @endif --}}
                @endforeach
            </div>
        </div>

    </section><!-- /Category Section Section -->

    <!-- Call To Action 2 Section -->
    <section id="crypto-cta" class="crypto-cta section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="crypto-offer d-flex flex-column flex-lg-row gap-4 align-items-center position-relative">
                <div class="content-left flex-grow-1" data-aos="fade-right" data-aos-delay="200">
                    <span class="badge text-uppercase mb-2">Limited Offer</span>
                    <h2>Tingkatkan Pengetahuan Crypto Anda Hari Ini</h2>
                    <p class="my-4">Kriptonesia membantu Anda menguasai pasar cryptocurrency dengan analisis mendalam dan
                        strategi trading terbaik. Bergabunglah dengan ribuan trader yang telah meningkatkan profit mereka
                        bersama kami.</p>

                    <div class="features d-flex flex-wrap gap-3 mb-4">
                        <div class="feature-item">
                            <i class="bi bi-check-circle-fill text-primary"></i>
                            <span>Analisis Pasar Harian</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-check-circle-fill text-primary"></i>
                            <span>Sinyal Trading Akurat</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-check-circle-fill text-primary"></i>
                            <span>Komunitas VIP Eksklusif</span>
                        </div>
                    </div>

                    <div class="cta-buttons d-flex flex-wrap gap-3">
                        <a href="{{ route('register') }}" class="btn btn-warning">
                            <i class="bi bi-lightning-fill me-2"></i>Mulai Sekarang
                        </a>
                        <a href="{{ route('produk') }}" class="btn btn-outline-primary">
                            <i class="bi bi-info-circle me-2"></i>Lihat Paket
                        </a>
                    </div>
                </div>

                <div class="content-right position-relative" data-aos="fade-left" data-aos-delay="300">
                    <img src="{{ asset('frontend/assets/img/cta/trading.jpg') }}" alt="Dashboard Kriptonesia"
                        class="img-fluid rounded-4">
                    <div class="floating-card bg-primary text-white">
                        <div class="card-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div class="card-content">
                            <span class="stats-number">89%</span>
                            <span class="stats-text">Accuracy Rate</span>
                        </div>
                    </div>
                </div>

                <div class="decoration">
                    <div class="circle-1"></div>
                    <div class="circle-2"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Call To Action 2 Section -->

    <!-- Latest Posts Section -->
    <section id="latest-posts" class="latest-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Postingan Terbaru</h2>
            <div><span>Cek</span> <span class="description-title">Postingan Terbaru Kami</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                @foreach ($terbaru as $item)
                    <div class="col-lg-4">
                        <article>

                            <div class="post-img">
                                <img src="{{ asset($item->image) }}" alt="" class="img-fluid">
                            </div>

                            <p class="post-category">{{ $item->category->name ?? 'Uncategorized' }}</p>

                            <h2 class="title">
                                <a href="{{ route('blog.isi', $item->slug) }}">{{ $item->judul }}</a>
                            </h2>

                            <div class="d-flex align-items-center">
                                <img src="assets/img/person/person-f-12.webp" alt=""
                                    class="img-fluid post-author-img flex-shrink-0">
                                <div class="post-meta">
                                    <p class="post-author">{{ $item->users->name ?? 'Uncategorized' }}</p>
                                    <p class="post-date">
                                        <time
                                            datetime="2022-01-01">{{ \Carbon\Carbon::parse($item->created_at)->format('M. d, Y') }}</time>
                                    </p>
                                </div>
                            </div>

                        </article>
                    </div><!-- End post list item -->
                @endforeach
            </div>
        </div>

    </section>
    <!-- /Latest Posts Section -->

    <!-- Harga Cryptocurrency LIVE Section -->
    <style>
        /* Button Default (Solid) */
        .btn-view-detail {
            display: inline-block;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 5px 15px rgba(255, 75, 43, 0.3);
        }

        .btn-view-detail:hover {
            background: linear-gradient(45deg, #8f94fb, #4e54c8);
            transform: scale(1.05);
            box-shadow: 0px 8px 20px rgba(78, 84, 200, 0.5);
        }

        /* Button Outline */
        .btn-view-detail.outline {
            background: transparent;
            color: #ff416c;
            border: 2px solid #ff416c;
            box-shadow: none;
        }

        .btn-view-detail.outline:hover {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: #fff;
            border-color: transparent;
            transform: scale(1.05);
            box-shadow: 0px 5px 15px rgba(255, 75, 43, 0.3);
        }

        .crypto-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .crypto-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .price-display {
            position: relative;
            padding: 12px 0;
        }

        .price {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1;
        }

        .change-badge {
            position: absolute;
            top: 0;
            right: 0;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 50px;
            color: white;
        }

        .card-header {
            padding: 1.25rem 1.25rem 0;
        }

        .card-body {
            padding: 0 1.25rem;
        }

        .card-footer {
            padding: 0 1.25rem 1.25rem;
        }

        @media (max-width: 767.98px) {
            .price {
                font-size: 1.5rem;
            }
        }
    </style>
    <section id="crypto-prices" class="crypto-prices section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <h2>Harga Cryptocurrency Terbaru</h2>
                    <div><span>Update</span> <span class="description-title">Realtime Market</span></div>
                </div>
                <div class="text-muted small">
                    <span class="me-2">Pembaruan Terakhir: {{ now()->setTimezone('Asia/Jakarta')->format('H:i') }} WIB</span>
                    <button onclick="window.location.reload()" class="btn btn-sm btn-view-detail outline">
                        <i class="fas fa-sync-alt me-1"></i> Refresh
                    </button>
                </div>
            </div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                @if (count($cryptoPrices) > 0)
                    @foreach ($cryptoList as $id => $crypto)
                        <div class="col-lg-4 col-md-6">
                            <div class="crypto-card h-100 transition-all">
                                <div
                                    class="card-header d-flex justify-content-between align-items-center bg-transparent border-0 pb-0">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $crypto['image'] }}" alt="{{ $crypto['name'] }}"
                                            class="img-fluid rounded-circle me-2" style="width: 32px; height: 32px;">
                                        <span class="fw-bold">{{ strtoupper($id) }}</span>
                                    </div>
                                    <span class="badge bg-light text-dark">{{ $loop->iteration }}</span>
                                </div>

                                <div class="card-body text-center pt-0">
                                    <h3 class="my-3">{{ $crypto['name'] }}</h3>

                                    <div class="price-display mb-3">
                                        <span
                                            class="price">${{ number_format($cryptoPrices[$id]['usd'] ?? 0, 2) }}</span>
                                        <span
                                            class="change-badge {{ ($cryptoPrices[$id]['usd_24h_change'] ?? 0) >= 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ ($cryptoPrices[$id]['usd_24h_change'] ?? 0) >= 0 ? '↑' : '↓' }}
                                            {{ number_format(abs($cryptoPrices[$id]['usd_24h_change'] ?? 0), 2) }}%
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <canvas id="sparkline-{{ $id }}" height="40"
                                            width="120"></canvas>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent border-0 pt-0">
                                    <a href="https://www.coingecko.com/en/coins/{{ $id }}" target="_blank"
                                        class="btn btn-sm btn-view-detail outline w-100">
                                        <i class="fas fa-chart-line me-1"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-warning d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-3 fs-4"></i>
                            <div>
                                <h5 class="alert-heading mb-1">Data Tidak Tersedia</h5>
                                <p class="mb-0">Kami sedang mengalami gangguan koneksi ke sumber data. Silakan coba
                                    beberapa saat lagi.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Generate random sparkline data
            @foreach ($cryptoList as $id => $crypto)
                const ctx{{ $loop->index }} = document.getElementById('sparkline-{{ $id }}')
                    .getContext('2d');
                const change = {{ $cryptoPrices[$id]['usd_24h_change'] ?? 0 }};

                // Generate sample data based on price change direction
                let data = [];
                let lastValue = 50;

                for (let i = 0; i < 10; i++) {
                    const variation = change >= 0 ?
                        Math.random() * 3 :
                        -Math.random() * 3;
                    lastValue += variation;
                    data.push(lastValue);
                }

                new Chart(ctx{{ $loop->index }}, {
                    type: 'line',
                    data: {
                        labels: Array(10).fill(''),
                        datasets: [{
                            data: data,
                            borderColor: change >= 0 ? '#28a745' : '#dc3545',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: false,
                            pointRadius: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                display: false
                            },
                            y: {
                                display: false
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            @endforeach
        });
    </script>
    <!-- End Harga Cryptocurrency LIVE Section -->


    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="cta-content" data-aos="fade-up" data-aos-delay="200">
                        <h2>Newsletter</h2>
                        <p>Dapatkan update terbaru seputar cryptocurrency langsung ke email Anda</p>
                        <form action="forms/newsletter.php" method="post" class="php-email-form cta-form"
                            data-aos="fade-up" data-aos-delay="300">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email address..."
                                    aria-label="Email address" aria-describedby="button-subscribe">
                                <button class="btn btn-primary" type="submit" id="button-subscribe">Subscribe</button>
                            </div>
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cta-image" data-aos="zoom-out" data-aos-delay="200">
                        <img src="{{ asset('frontend/assets/img/cta/cta-1.webp') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Call To Action Section -->
@endsection
