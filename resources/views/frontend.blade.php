@extends('frontend.index')
@section('title')
    Beranda
@endsection

@section('content')
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
                    @if ($category->posts->isNotEmpty())
                        @foreach ($category->posts as $post)
                            <div class="col-xl-4 col-lg-6">
                                <article class="list-post">
                                    <div class="post-img">
                                        <img src="{{ asset($post->image) }}" alt="" class="img-fluid"
                                            loading="lazy">
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
                    @else
                        <p>Belum ada post di kategori ini.</p>
                    @endif
                @endforeach
            </div>
        </div>

    </section><!-- /Category Section Section -->

    <!-- Call To Action 2 Section -->
    <section id="call-to-action-2" class="call-to-action-2 section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="advertise-1 d-flex flex-column flex-lg-row gap-4 align-items-center position-relative">

                <div class="content-left flex-grow-1" data-aos="fade-right" data-aos-delay="200">
                    <span class="badge text-uppercase mb-2">Don't Miss</span>
                    <h2>Revolutionize Your Digital Experience Today</h2>
                    <p class="my-4">Strategia accelerates your business growth through innovative solutions and
                        cutting-edge technology. Join thousands of satisfied customers who have transformed their
                        operations.</p>

                    <div class="features d-flex flex-wrap gap-3 mb-4">
                        <div class="feature-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Premium Support</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Cloud Integration</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Real-time Analytics</span>
                        </div>
                    </div>

                    <div class="cta-buttons d-flex flex-wrap gap-3">
                        <a href="#" class="btn btn-primary">Start Free Trial</a>
                        <a href="#" class="btn btn-outline">Learn More</a>
                    </div>
                </div>

                <div class="content-right position-relative" data-aos="fade-left" data-aos-delay="300">
                    <img src="assets/img/misc/misc-1.webp" alt="Digital Platform" class="img-fluid rounded-4">
                    <div class="floating-card">
                        <div class="card-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div class="card-content">
                            <span class="stats-number">245%</span>
                            <span class="stats-text">Growth Rate</span>
                        </div>
                    </div>
                </div>

                <div class="decoration">
                    <div class="circle-1"></div>
                    <div class="circle-2"></div>
                </div>

            </div>

        </div>

    </section><!-- /Call To Action 2 Section -->

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

    </section><!-- /Latest Posts Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="cta-content" data-aos="fade-up" data-aos-delay="200">
                        <h2>Subscribe to our newsletter</h2>
                        <p>Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur
                            aliquet quam id dui posuere blandit.</p>
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
                        <img src="assets/img/cta/cta-1.webp" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Call To Action Section -->
@endsection
