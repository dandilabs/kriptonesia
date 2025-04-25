@extends('layouts.member')

@section('content')
    <style>
        .card-news {
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card-news:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }

        .placeholder-img {
            height: 180px;
            background: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
        }

        .card-title {
            font-size: 1.05rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .badge-currency {
            background-color: #d1ecf1;
            color: #0c5460;
            font-size: 0.7rem;
            padding: 4px 6px;
        }

        .btn-read {
            font-size: 0.75rem;
            padding: 5px 10px;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <h4><i class="fas fa-coins me-2"></i>Crypto News</h4>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    @if ($lastUpdated)
                        <small class="text-muted">
                            <i class="far fa-clock me-1"></i> Terakhir diperbarui: {{ \Carbon\Carbon::parse($lastUpdated)->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                        </small>
                    @endif
                </div>
                <form action="{{ route('crypto-news.fetch') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-sync-alt me-1"></i> Perbarui Berita
                    </button>
                </form>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                </div>
            @endif

            <div class="row">
                @forelse($news as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card card-news shadow-sm h-100">
                            @if ($item->image_url)
                                <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->title }}">
                            @else
                                <div class="placeholder-img">
                                    <i class="fas fa-newspaper fa-2x"></i>
                                </div>
                            @endif

                            <div class="card-body pb-2">
                                @if ($item->source_icon)
                                    <div class="mb-2 d-flex align-items-center">
                                        <img src="{{ $item->source_icon }}" alt="{{ $item->source }}" style="height: 16px;"
                                            class="me-2">
                                        <small class="text-muted">{{ $item->source }}</small>
                                    </div>
                                @endif
                                <h5 class="card-title">{{ Str::limit($item->title, 70) }}</h5>
                                @if ($item->summary)
                                    <p class="card-text">{{ Str::limit($item->summary, 100) }}</p>
                                @endif
                            </div>

                            <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                                <a href="{{ $item->url }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary btn-read">
                                    <i class="fas fa-external-link-alt me-1"></i> Baca
                                </a>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="badge badge-{{ $item->votes >= 0 ? 'success' : 'danger' }}">
                                        <i class="fas fa-thumbs-{{ $item->votes >= 0 ? 'up' : 'down' }}"></i>
                                        {{ $item->votes }}
                                    </span>
                                    @if (!empty($item->currencies))
                                        @foreach ((array) $item->currencies as $currency)
                                            @php
                                                $currencyCode = is_array($currency)
                                                    ? $currency['code'] ?? ''
                                                    : $currency->code ?? '';
                                            @endphp
                                            @if ($currencyCode)
                                                <span class="badge badge-currency">{{ $currencyCode }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="px-3 pb-3">
                                <small class="text-muted d-block">
                                    <i class="far fa-clock me-1"></i> {{ $item->published_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            <i class="fas fa-exclamation-circle fa-2x text-muted mb-2 d-block"></i>
                            <h5 class="mb-1">Tidak ada berita tersedia</h5>
                            <p class="mb-3">Silakan perbarui untuk mendapatkan berita terbaru</p>
                            <form action="{{ route('crypto-news.fetch') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-sync-alt me-2"></i> Perbarui Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($news->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $news->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
