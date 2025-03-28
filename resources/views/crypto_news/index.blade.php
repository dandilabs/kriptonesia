@extends('template.index')
@section('title')
    Berita Crypto
@endsection
@section('content')
    <!--================Hero Banner start =================-->
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner">
                <div class="hero-banner__content text-center">
                    <h3 class="text-white">Crypto Market Insights</h3>
                    <h2 class="text-warning">Apa yang Harus Diketahui Hari Ini?</h2>
                    <p class="text-white">Berita, analisis, dan tren terbaru untuk membantu Anda tetap selangkah lebih maju.
                    </p>
                    <h4 class="text-light">{{ \Carbon\Carbon::now()->format('F d, Y') }}</h4>
                    <a href="#" class="button mt-3">Lihat Berita</a>
                </div>
            </div>
        </div>
    </section>
    <!--================Hero Banner end =================-->
    <section class="blog-post-area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @foreach ($pagination as $item)
                            <div class="col-md-6">
                                <div class="single-recent-blog-post card-view">
                                    <div class="thumb">
                                        <img class="card-img rounded-0 img-fluid"
                                            src="{{ $item['image_url'] ?? asset('assets/img/default-news.jpg') }}"
                                            alt="">
                                        <ul class="thumb-info">
                                            <li><a href="{{ $item['link'] }}" target="_blank">{{ $item['title'] }}</a></li>
                                            <li><a href="#" style="font-size: 12px;"><i
                                                        class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($item['pubDate'])->diffForHumans() }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="blog-pagination justify-content-center d-flex">
                                {{ $pagination->links() }}
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Start Blog Post Siddebar -->
                @include('template.sidebar')
            </div>
            <!-- End Blog Post Siddebar -->
        </div>
    </section>
@endsection
