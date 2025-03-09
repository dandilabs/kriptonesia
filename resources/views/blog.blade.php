@extends('template.index')
@section('content')
<!--================Hero Banner start =================-->
<section class="mb-30px">
    <div class="container">
        <div class="hero-banner">
            <div class="hero-banner__content">
                <h3>Tours & Travels</h3>
                <h1>Amazing Places on earth</h1>
                <h4>December 12, 2018</h4>
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
                                        <img class="card-img rounded-0" src="{{ $item->image }}" alt="">
                                        <ul class="thumb-info">
                                            <li><a href="#" style="font-size: 12px;"><i class="ti-user"></i>{{ $item->users->name }}</a></li>
                                            <li><a href="#" style="font-size: 12px;"><i class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</a></li>
                                        </ul>
                                    </div>
                                    <div class="details mt-20">
                                        <a href="{{route('blog.isi', $item->slug)}}">
                                            <h3>{{ $item->judul }}</h3>
                                        </a>
                                        <p class="tag-list-inline">Tag:
                                            @foreach ($item->tags as $tag)
                                                <a href="#">{{ $tag->name }}</a>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </p>
                                        {{-- <p>{{ $item->content }}</p> --}}
                                        <a class="button" href="{{route('blog.isi', $item->slug)}}">Read More <i class="ti-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="blog-pagination justify-content-center d-flex">
                                {{ $data->links() }}
                                {{-- <ul class="pagination">
                                    <li class="page-item">
                                        <a href="#" class="page-link" aria-label="Previous">
                                            <span aria-hidden="true">
                                                <i class="ti-angle-left"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item">
                                        <a href="#" class="page-link" aria-label="Next">
                                            <span aria-hidden="true">
                                                <i class="ti-angle-right"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul> --}}
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
