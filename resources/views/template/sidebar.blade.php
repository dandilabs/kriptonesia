<div class="col-lg-4 sidebar-widgets">
    <div class="widget-wrap">
        <div class="single-sidebar-widget post-category-widget">
            <h4 class="single-sidebar-widget__title">Kategori</h4>
            <ul class="cat-list mt-20">
                @foreach ($category_sidebar as $hasil)
                    <li>
                        <a href="{{ route('blog.category', $hasil->slug) }}" class="d-flex justify-content-between">
                            <p>{{ $hasil->name }}</p>
                            <p>( {{ $hasil->posts->count() }} )</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="single-sidebar-widget popular-post-widget">
            <h4 class="single-sidebar-widget__title">Popular Post</h4>
            <div class="popular-post-list">
                @foreach ($popular_posts as $post)
                    <div class="single-post-list">
                        <div class="thumb">
                            <img class="card-img rounded-0" src="{{ asset($post->image) }}" alt="">
                            <ul class="thumb-info">
                                <li><a href="#">{{ $post->users->name }}</a></li>
                                <li><a
                                        href="#">{{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="details mt-20">
                            <a href="{{ route('blog.isi', $post->slug) }}">
                                <h6>{{ Str::limit($post->judul, 50) }}</h6>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="single-sidebar-widget tag_cloud_widget">
            <h4 class="single-sidebar-widget__title">Popular Tags</h4>
            <ul class="list">
                @foreach ($popular_tags as $tag)
                    <li>
                        <a href="{{ route('blog.tag', $tag->slug) }}">{{ $tag->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
