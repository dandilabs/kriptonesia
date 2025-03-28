@extends('template.index')
@section('title')
    Beranda
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
                        @foreach ($data as $item)
                            <div class="col-md-6">
                                <div class="single-recent-blog-post card-view">
                                    <div class="thumb">
                                        <img class="card-img rounded-0 img-fluid" src="{{ asset($item->image) }}" alt="">
                                        <ul class="thumb-info">
                                            <li><a href="#" style="font-size: 12px;"><i
                                                        class="ti-user"></i>{{ $item->users->name }}</a></li>
                                            <li><a href="#" style="font-size: 12px;"><i
                                                        class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="details mt-20">
                                        <a href="{{ route('blog.isi', $item->slug) }}">
                                            <h3>{{ $item->judul }}</h3>
                                        </a>
                                        <p class="tag-list-inline">Tag:
                                            @foreach ($item->tags as $tag)
                                                <a href="#" class="badge badge-warning">{{ $tag->name }}</a>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </p>
                                        {{-- <p>{{ $item->content }}</p> --}}
                                        <a class="button" href="{{ route('blog.isi', $item->slug) }}">Read More <i
                                                class="ti-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="blog-pagination justify-content-center d-flex">
                                {{ $data->links() }}
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
