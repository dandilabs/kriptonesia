@extends('layouts.member')
@section('content')
    @include('sweetalert::alert')
    <div class="col-md-12 mb-4">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-crown"></i> Premium Features
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-gradient-indigo">
                            <div class="inner">
                                <h3>{{ $signalsToday }}</h3>
                                <p>Signal Hari Ini</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <a href="{{ route('member.signals') }}" class="small-box-footer">
                                Lihat <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-gradient-purple">
                            <div class="inner">
                                <h3>{{ $winRate }}<sup style="font-size: 20px">%</sup></h3>
                                <p>Win Rate</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <a href="{{ route('member.performance') }}" class="small-box-footer">
                                Analisis <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-gradient-maroon">
                            <div class="inner">
                                <h3>{{ $communityMembers }}</h3>
                                <p>Anggota VIP</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="{{ route('member.community') }}" class="small-box-footer">
                                Gabung <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-gradient-orange">
                            <div class="inner">
                                <h3>{{ $exclusiveContent }}</h3>
                                <p>Konten Eksklusif</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-lock-open"></i>
                            </div>
                            <a href="{{ route('member.exclusive') }}" class="small-box-footer">
                                Akses <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
