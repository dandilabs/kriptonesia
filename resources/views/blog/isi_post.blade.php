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
                <div class="col-lg-8">
                    <div class="main_blog_details">
                        <img class="img-fluid" src="{{ asset($post->image) }}" alt="">
                        <a href="#">
                            <h4>{{ $post->judul ?? 'Judul Tidak Ditemukan' }}</h4>
                        </a>
                        <div class="user_details">
                            <div class="float-left">
                                @if ($post->category)
                                    <!-- Pastikan category ada -->
                                    <a href="{{ route('blog.category', $post->slug) }}">{{ $post->category->name }}</a>
                                @endif
                            </div>
                            <div class="float-right mt-sm-0 mt-3">
                                <div class="media">
                                    <div class="media-body">
                                        <h5>{{ $post->users->name ?? 'Penulis Tidak Diketahui' }}</h5>
                                        <p>{{ $post->created_at->format('d M, Y h:i A') }}</p>
                                    </div>
                                    <div class="d-flex">
                                        <img width="42" height="42"
                                            src="{{ asset($post->users->avatar ?? 'default-avatar.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-justify">{!! $post->content !!}</p>
                        <!-- ... bagian footer tetap sama ... -->
                    </div>
                </div>

                <!-- Start Blog Post Siddebar -->
                @include('template.sidebar')
            </div>
        </div>
    </section>
    <!--================ End Blog Post Area =================-->
@endsection
