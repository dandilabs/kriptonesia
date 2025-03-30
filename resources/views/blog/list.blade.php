@extends('frontend.index')
@section(section: 'title')
    List Kategori
@endsection
@section('content')
    <!-- Page Title -->
    <div class="page-title position-relative">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a></li>
                    <li class="breadcrumb-item active current">List Kategori</li>
                </ol>
            </nav>
        </div>

        <div class="title-wrapper">
            <h1>List Kategori</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Category Postst Section -->
                <section id="category-postst" class="category-postst section">

                    <div class="container" data-aos="fade-up" data-aos-delay="100">
                        <div class="row gy-4">
                            @foreach ($data as $list)
                                <div class="col-lg-6">
                                    <article>

                                        <div class="post-img">
                                            <img src="{{ asset($list->image) }}" alt="" class="img-fluid">
                                        </div>

                                        <p class="post-category">Politics</p>

                                        <h2 class="title">
                                            <a href="{{ route('blog.isi', $list->slug) }}">{{ $list->judul }}.</a>
                                        </h2>

                                        <div class="d-flex align-items-center">
                                            <img src="assets/img/person/person-f-12.webp" alt=""
                                                class="img-fluid post-author-img flex-shrink-0">
                                            <div class="post-meta">
                                                <p class="post-author">{{ $list->users->name }}</p>
                                                <p class="post-date">
                                                    <time datetime="2022-01-01">{{ \Carbon\Carbon::parse($list->created_at)->format('d M, Y h:i A') }}</time>
                                                </p>
                                            </div>
                                        </div>

                                    </article>
                                </div><!-- End post list item -->
                            @endforeach
                        </div>
                    </div>

                </section><!-- /Category Postst Section -->

                <!-- Pagination 2 Section -->
                <section id="pagination-2" class="pagination-2 section">

                    <div class="container">
                        <div class="d-flex justify-content-center">
                            {{ $data->links('vendor.pagination.custom') }}
                        </div>
                    </div>

                </section><!-- /Pagination 2 Section -->

            </div>

            <div class="col-lg-4 sidebar">

                <div class="widgets-container" data-aos="fade-up" data-aos-delay="200">

                    <!-- Search Widget -->
                    <div class="search-widget widget-item">

                        <h3 class="widget-title">Search</h3>
                        <form action="">
                            <input type="text">
                            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                        </form>

                    </div><!--/Search Widget -->

                    <!-- Categories Widget -->
                    <div class="categories-widget widget-item">

                        <h3 class="widget-title">Kategori</h3>
                        <ul class="mt-3">
                            @foreach ($category_sidebar as $hasil)
                                <li>
                                    <a href="{{ route('blog.category', $hasil->slug) }}">{{ $hasil->name }} <span>(
                                            {{ $hasil->posts->count() }} )</span></a>
                                </li>
                            @endforeach
                        </ul>

                    </div><!--/Categories Widget -->

                    <!-- Recent Posts Widget -->
                    <div class="recent-posts-widget widget-item">

                        <h3 class="widget-title">Postingan terbaru</h3>
                        @foreach ($data as $hasil)
                            <div class="post-item">
                                <img src="{{ asset($hasil->image) }}" alt="" class="flex-shrink-0">
                                <div>
                                    <h4><a href="{{ route('blog.isi', $hasil->slug) }}">{{ $hasil->judul }}</a></h4>
                                    <time
                                        datetime="2020-01-01">{{ \Carbon\Carbon::parse($hasil->created_at)->format('M. d, Y') }}</time>
                                </div>
                            </div>
                        @endforeach

                    </div><!--/Recent Posts Widget -->

                    <!-- Tags Widget -->
                    <div class="tags-widget widget-item">

                        <h3 class="widget-title">Tags</h3>
                        <ul>
                            @foreach ($popular_tags as $tag)
                                <li><a href="{{ route('blog.tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>

                    </div><!--/Tags Widget -->

                </div>

            </div>

        </div>
    </div>
@endsection
