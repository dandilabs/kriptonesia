@extends('layouts.member')

@section('content')
    @include('sweetalert::alert')
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                {{-- <h3>{{ $newsCount }}</h3> --}}
                <p>Berita Eksklusif</p>
            </div>
            <div class="icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <a href="{{ route('member.news') }}" class="small-box-footer">
                Akses <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                {{-- <h3>{{ $marketUpdates }}</h3> --}}
                <p>Update Pasar</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="#" class="small-box-footer">
                Lihat <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                {{-- <h3>{{ $airdropCount }}</h3> --}}
                <p>Info Airdrop</p>
            </div>
            <div class="icon">
                <i class="fas fa-gift"></i>
            </div>
            <a href="# class="small-box-footer">
                Cek <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
@endsection
