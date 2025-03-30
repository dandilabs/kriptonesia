<style>
    .pagination-list {
        display: flex;
        align-items: center;
        list-style: none;
        padding: 0;
        gap: 10px;
    }

    .pagination-list li {
        margin: 0;
        padding: 0;
    }

    .pagination-list li a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s;
        border: 2px solid #ff5722;
        color: #ff5722;
    }

    .pagination-list li a.active {
        background-color: #ff5722;
        color: #fff;
    }

    .pagination-list li a:hover {
        background-color: #ff5722;
        color: #fff;
    }

    .pagination-list li.disabled span {
        color: #bbb;
    }
</style>
@if ($paginator->hasPages())
    <section id="pagination-2" class="pagination-2 section">
        <div class="container">
            <div class="d-flex justify-content-center">
                <ul class="pagination-list">
                    {{-- Tombol Previous --}}
                    @if (!$paginator->onFirstPage())
                        <li><a href="{{ $paginator->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a></li>
                    @endif

                    {{-- Nomor Halaman --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <li>
                                    <a href="{{ $url }}"
                                        class="{{ $page == $paginator->currentPage() ? 'active' : '' }}">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Tombol Next --}}
                    @if ($paginator->hasMorePages())
                        <li><a href="{{ $paginator->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </section>
@endif
