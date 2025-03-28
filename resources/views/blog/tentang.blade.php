@extends('frontend.index')
@section('title')
    Tentang Kami | Platform Edukasi Cryptocurrency Terpercaya
@endsection

@section('content')
    <!--================ Hero Banner Start =================-->
    <!-- Page Title -->
    <div class="page-title">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a></li>
                    <li class="breadcrumb-item active current">Tentang Kami</li>
                </ol>
            </nav>
        </div>

        <div class="title-wrapper">
            <h1>Mengenal Kriptonesia</h1>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis,
                pulvinar dapibus leo.</p> --}}
        </div>
    </div><!-- End Page Title -->
    <!--================ Hero Banner End =================-->

    <!--================ About Section Start =================-->
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="section-title mb-4">
                        <h2 class="mb-3">Siapa Kami?</h2>
                        <div class="title-border"></div>
                    </div>
                    <div class="about-content">
                        <p class="text-justify mb-4">Kriptonesia merupakan <strong>platform edukasi cryptocurrency
                                terkemuka</strong> di Indonesia yang berkomitmen menyediakan pengetahuan mendalam tentang
                            aset digital bagi semua kalangan, dari pemula hingga trader profesional.</p>

                        <div class="about-feature mb-4">
                            <div class="feature-item d-flex mb-3">
                                <div class="feature-icon mr-3">
                                    <i class="fas fa-chart-line text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-2">Analisis Pasar Terkini</h5>
                                    <p class="mb-0">Update harian pergerakan pasar crypto dengan insight dari analis
                                        berpengalaman</p>
                                </div>
                            </div>
                            <div class="feature-item d-flex mb-3">
                                <div class="feature-icon mr-3">
                                    <i class="fas fa-graduation-cap text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-2">Materi Edukasi Komprehensif</h5>
                                    <p class="mb-0">Panduan lengkap dari dasar blockchain hingga strategi trading kompleks
                                    </p>
                                </div>
                            </div>
                            <div class="feature-item d-flex">
                                <div class="feature-icon mr-3">
                                    <i class="fas fa-users text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-2">Komunitas Aktif</h5>
                                    <p class="mb-0">Interaksi langsung dengan trader dan investor crypto berpengalaman</p>
                                </div>
                            </div>
                        </div>

                        <blockquote class="blockquote bg-light p-4 rounded">
                            <p class="mb-0 font-italic">"Di dunia crypto yang penuh volatilitas, pengetahuan adalah aset
                                terbaik yang bisa Anda miliki."</p>
                            <footer class="blockquote-footer mt-2">Tim Kriptonesia</footer>
                        </blockquote>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-img position-relative">
                        <img src="{{ asset('assets/img/tentangkami.png') }}" alt="Tentang Kriptonesia"
                            class="img-fluid rounded-lg shadow-lg">
                        <div class="about-experience bg-primary text-white rounded-lg p-3 shadow">
                            <h2 class="text-white mb-0">5+</h2>
                            <p class="mb-0">Tahun Pengalaman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ About Section End =================-->

    <!--================ Vision Mission Start =================-->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="mb-3">Visi & Misi Kami</h2>
                <p class="lead">Landasan yang memandu setiap langkah kami</p>
                <div class="title-border mx-auto"></div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="icon-box bg-primary-light rounded-circle mx-auto">
                                    <i class="fas fa-eye text-primary"></i>
                                </div>
                            </div>
                            <h3 class="text-center mb-4">Visi</h3>
                            <p class="text-center text-justify">Menjadi rujukan utama edukasi cryptocurrency di Asia
                                Tenggara yang membangun generasi investor digital yang cerdas, melek teknologi, dan
                                beretika.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="icon-box bg-primary-light rounded-circle mx-auto">
                                    <i class="fas fa-bullseye text-primary"></i>
                                </div>
                            </div>
                            <h3 class="text-center mb-4">Misi</h3>
                            <ul class="list-unstyled mission-list">
                                <li class="d-flex mb-3">
                                    <div class="mr-3">
                                        <i class="fas fa-check-circle text-primary"></i>
                                    </div>
                                    <span>Menyediakan konten edukasi yang akurat dan mudah dipahami</span>
                                </li>
                                <li class="d-flex mb-3">
                                    <div class="mr-3">
                                        <i class="fas fa-check-circle text-primary"></i>
                                    </div>
                                    <span>Mengembangkan tools analisis untuk membantu pengambilan keputusan investasi</span>
                                </li>
                                <li class="d-flex mb-3">
                                    <div class="mr-3">
                                        <i class="fas fa-check-circle text-primary"></i>
                                    </div>
                                    <span>Membangun ekosistem komunitas yang saling mendukung</span>
                                </li>
                                <li class="d-flex">
                                    <div class="mr-3">
                                        <i class="fas fa-check-circle text-primary"></i>
                                    </div>
                                    <span>Mendorong adopsi teknologi blockchain secara bertanggung jawab</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Vision Mission End =================-->

    <!--================ Story Section Start =================-->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="section-title text-center mb-5">
                        <h2 class="mb-3">Perjalanan Kami</h2>
                        <p>Dari ide sederhana menjadi platform edukasi terpercaya</p>
                        <div class="title-border mx-auto"></div>
                    </div>

                    <div class="timeline">
                        <div class="timeline-container left">
                            <div class="timeline-content shadow-sm">
                                <h4>2018</h4>
                                <p>Kriptonesia didirikan sebagai blog sederhana berisi panduan dasar cryptocurrency</p>
                            </div>
                        </div>
                        <div class="timeline-container right">
                            <div class="timeline-content shadow-sm">
                                <h4>2019</h4>
                                <p>Meluncurkan kursus online pertama tentang trading Bitcoin</p>
                            </div>
                        </div>
                        <div class="timeline-container left">
                            <div class="timeline-content shadow-sm">
                                <h4>2020</h4>
                                <p>Mengembangkan platform membership dengan fitur analisis harian</p>
                            </div>
                        </div>
                        <div class="timeline-container right">
                            <div class="timeline-content shadow-sm">
                                <h4>2022</h4>
                                <p>Mencapai 50.000 anggota komunitas aktif</p>
                            </div>
                        </div>
                        <div class="timeline-container left">
                            <div class="timeline-content shadow-sm">
                                <h4>Sekarang</h4>
                                <p>Terus berkembang sebagai pusat edukasi crypto terkemuka di Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Story Section End =================-->

    <!--================ CTA Section Start =================-->
    <section class="cta-section bg-gradient-primary text-white section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="mb-3 text-white">Siap Memulai Perjalanan Crypto Anda?</h2>
                    <p class="mb-0">Bergabunglah dengan ribuan anggota kami yang telah menemukan cara lebih cerdas
                        berinvestasi di dunia cryptocurrency.</p>
                </div>
                <div class="col-lg-4 text-lg-right">
                    <a href="{{ route('register') }}" class="button button-light">Daftar Sekarang</a>
                    <a href="#" class="button button-outline-light ml-2">Kontak Kami</a>
                </div>
            </div>
        </div>
    </section>
    <!--================ CTA Section End =================-->
@endsection

@push('styles')
    <style>
        /* Hero Banner */
        .hero-banner--sm {
            padding: 100px 0;
            background-size: cover;
            position: relative;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Section Title */
        .section-title h2 {
            position: relative;
            padding-bottom: 15px;
        }

        .title-border {
            width: 80px;
            height: 3px;
            background: #667eea;
            margin-top: 15px;
        }

        /* About Feature */
        .feature-icon {
            font-size: 24px;
            min-width: 40px;
        }

        /* Timeline */
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }

        .timeline::after {
            content: '';
            position: absolute;
            width: 3px;
            background-color: #667eea;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -1.5px;
        }

        .timeline-container {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }

        .timeline-content {
            padding: 20px;
            background-color: white;
            position: relative;
            border-radius: 8px;
            border-left: 3px solid #667eea;
        }

        /* Responsive timeline */
        @media screen and (max-width: 768px) {
            .timeline::after {
                left: 31px;
            }

            .timeline-container {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
        }
    </style>
@endpush
