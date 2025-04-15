@extends('layouts.member')
@section('content')
    @include('sweetalert::alert')
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">
                <i class="fas fa-history"></i> Aktivitas Terakhir
            </h3>
        </div>
        <div class="card-body p-0">
            <ul class="products-list product-list-in-card pl-2 pr-2">
                @foreach ($recentActivities as $activity)
                    <li class="item">
                        <div class="product-info">
                            <a href="{{ $activity['link'] }}" class="product-title">
                                {{ $activity['title'] }}
                                <span class="badge badge-{{ $activity['type'] }} float-right">{{ $activity['time'] }}</span>
                            </a>
                            <span class="product-description">
                                {{ $activity['description'] }}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('member.activity') }}" class="uppercase">Lihat Semua Aktivitas</a>
        </div>
    </div>
@endsection
