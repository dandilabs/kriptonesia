@extends('template.index')
@section('content')
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

    <section class="blog-post-area section-margin mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @foreach ($data as $list)
                    <div class="single-recent-blog-post">
                        <div class="thumb">
                            <img class="img-fluid" src="{{ asset($list->image) }}" alt="">
                            <ul class="thumb-info">
                                <li><a href="#" style="font-size: 13px;"><i class="ti-user"></i>{{ $list->users->name }}</a></li>
                                <li><a href="#" style="font-size: 13px;"><i class="ti-notepad"></i>{{ \Carbon\Carbon::parse($list->created_at)->format('d M, Y h:i A') }}</a></li>
                                {{-- <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li> --}}
                            </ul>
                        </div>
                        <div class="details mt-20">
                            <a href="{{ route('blog.isi', $list->slug) }}">
                                <h3>{{ $list->judul}}.</h3>
                            </a>
                            <p class="tag-list-inline">Tag:
                                @foreach ($list->tags as $tag)
                                    <a href="#">{{ $tag->name }}</a>
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </p>
                            <p class="text-justify">{!! $list->content !!}</p>
                            <a class="button" href="{{ route('blog.isi', $list->slug) }}">Read More <i class="ti-arrow-right"></i></a>
                        </div>
                    </div>
                    @endforeach

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
