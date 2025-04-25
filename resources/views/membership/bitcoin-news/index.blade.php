@extends('layouts.member')
@section('content')
    <div class="container py-4">
        <div class="row justify-content-between mb-4">
            <div class="col-md-8">
                <h1>Bitcoin News Aggregator</h1>
                @if ($lastUpdated)
                    <p class="text-muted">Terakhir diperbarui: {{ $lastUpdated }}</p>
                @endif
            </div>
            <div class="col-md-4 text-end">
                <form action="{{ route('bitcoin-news.fetch') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-arrow-repeat"></i> Perbarui Berita
                    </button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            @forelse($news as $item)
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            @if($item->image_url)
                <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
            @else
                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="fas fa-newspaper fa-4x text-white"></i>
                </div>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $item->title }}</h5>
                <p class="card-text">{{ $item->excerpt }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge bg-primary">{{ $item->source }}</span>
                    <span class="text-muted small">
                        <i class="far fa-clock"></i> {{ $item->published_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ $item->url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-external-link-alt"></i> Baca Selengkapnya
                    </a>
                    @if($item->social_score > 0)
                        <span class="badge bg-info">
                            <i class="fas fa-bolt"></i> {{ $item->social_score }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="alert alert-warning">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                <div>
                    <h5>Tidak ada berita tersedia</h5>
                    <p class="mb-0">Silakan klik tombol dibawah untuk memperbarui data</p>
                </div>
            </div>
            <div class="mt-3 text-center">
                <form action="{{ route('bitcoin-news.fetch') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-sync-alt me-2"></i> PERBARUI SEKARANG
                    </button>
                </form>
            </div>
        </div>
    </div>
@endforelse
        </div>

        @if ($news->count())
            <div class="d-flex justify-content-center mt-4">
                {{ $news->links() }}
            </div>
        @endif
    </div>
@endsection
