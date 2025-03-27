@extends('template.index')
@section(section: 'title')
    Detail
@endsection
@section('content')
    <!--================Hero Banner start =================-->
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content">
                    <h1>Blog details</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--================Hero Banner end =================-->
    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin">
        <div class="container">
            <div class="row">
                @foreach ($data as $isi_post)
                <div class="col-lg-8">
                    <div class="main_blog_details">
                        <img class="img-fluid" src="{{ asset($isi_post->image)}}" alt="">
                        <a href="#">
                            <h4>{{ $isi_post->judul }}</h4>
                        </a>
                        <div class="user_details">
                            <div class="float-left">
                                <a href="#">{{ $isi_post->category->name }}</a>
                                {{-- @foreach ($isi_post->categories as $category)
                                    <a href="#">{{ $category->name }}</a>
                                @endforeach --}}
                            </div>
                            <div class="float-right mt-sm-0 mt-3">
                                <div class="media">
                                    <div class="media-body">
                                        <h5>{{ $isi_post->users->name }}</h5>
                                        <p>{{ \Carbon\Carbon::parse($isi_post->created_at)->format('d M, Y h:i A') }}</p>
                                    </div>
                                    <div class="d-flex">
                                        <img width="42" height="42" src="{{ asset($isi_post->image)}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-justify">{!! $isi_post->content !!}</p>
                        {{-- <blockquote class="blockquote">
                            <p class="mb-0">MCSE boot camps have its supporters and its detractors. Some people do not
                                understand why you should have to spend money on boot camp when you can get the MCSE study
                                materials yourself at a fraction of the camp price. However, who has the willpower to
                                actually sit through a self-imposed MCSE training.</p>
                        </blockquote> --}}
                        <div class="news_d_footer flex-column flex-sm-row">
                            <a href="#"><span class="align-middle mr-2"><i class="ti-heart"></i></span>Lily and 4
                                people like this</a>
                            <a class="justify-content-sm-center ml-sm-auto mt-sm-0 mt-2" href="#"><span
                                    class="align-middle mr-2"><i class="ti-themify-favicon"></i></span>06 Comments</a>
                            <div class="news_socail ml-sm-auto mt-sm-0 mt-2">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Start Blog Post Siddebar -->
                @include('template.sidebar')
            </div>
            <!-- End Blog Post Siddebar -->
        </div>
    </section>
    <!--================ End Blog Post Area =================-->
@endsection
