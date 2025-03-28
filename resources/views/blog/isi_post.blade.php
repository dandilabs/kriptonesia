@extends('frontend.index')
@section(section: 'title')
    Detail
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container" data-aos="fade-up">

                        <article class="article">

                            <div class="hero-img" data-aos="zoom-in">
                                <img src="{{ asset($post->image) }}" alt="Featured blog image" class="img-fluid"
                                    loading="lazy">
                                <div class="meta-overlay">
                                    <div class="meta-categories">
                                        @if ($post->category)
                                            <a href="{{ route('blog.category', $post->slug) }}" class="category">{{ $post->category->name }}</a>
                                        @endif
                                        <span class="divider">•</span>
                                        <span class="reading-time"><i class="bi bi-clock"></i> 6 min read</span>
                                    </div>
                                </div>
                            </div>

                            <div class="article-content" data-aos="fade-up" data-aos-delay="100">
                                <div class="content-header">
                                    <h1 class="title">{{ $post->judul ?? 'Judul Tidak Ditemukan' }}</h1>

                                    <div class="author-info">
                                        <div class="author-details">
                                            {{-- <img src="assets/img/person/person-f-8.webp" alt="Author" class="author-img"> --}}
                                            <div class="info">
                                                <h4>{{ $post->users->name ?? 'Penulis Tidak Diketahui' }}</h4>
                                                {{-- <span class="role">{{ $post->users->name ?? 'Penulis Tidak Diketahui' }}</span> --}}
                                            </div>
                                        </div>
                                        <div class="post-meta">
                                            <span class="date"><i class="bi bi-calendar3"></i> Mar 15, 2025</span>
                                            <span class="divider">•</span>
                                            {{-- <span class="comments"><i class="bi bi-chat-text"></i> 18 Comments</span> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="content">
                                    <p class="lead text-justify">
                                        {!! $post->content !!}
                                    </p>
                                </div>

                                <div class="meta-bottom">
                                    <div class="tags-section">
                                        <h4>Related Topics</h4>
                                        <div class="tags">
                                            <a href="#" class="tag">Web Development</a>
                                            <a href="#" class="tag">Performance</a>
                                            <a href="#" class="tag">Best Practices</a>
                                            <a href="#" class="tag">Trends</a>
                                            <a href="#" class="tag">2025</a>
                                        </div>
                                    </div>

                                    <div class="share-section">
                                        <h4>Share Article</h4>
                                        <div class="social-links">
                                            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                            <a href="#" class="copy-link" title="Copy Link"><i
                                                    class="bi bi-link-45deg"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </article>

                    </div>
                </section><!-- /Blog Details Section -->
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

                        <h3 class="widget-title">Categories</h3>
                        <ul class="mt-3">
                            @foreach ($category_sidebar as $hasil)
                                <li>
                                    <a href="{{ route('blog.category', $hasil->slug) }}">{{ $hasil->name }} <span>( {{ $hasil->posts->count() }} )</span></a>
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
                                    <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($hasil->created_at)->format('M. d, Y') }}</time>
                                </div>
                            </div>
                        @endforeach<!-- End recent post item-->

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
