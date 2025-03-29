@extends('frontend.index')
@section('title')
    Tentang Kami | Platform Edukasi Cryptocurrency Terpercaya
@endsection

@section('content')
    <style>
        /* CTA Section */
        .cta-section {
            padding: 60px 0;
            position: relative;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            text-align: center;
        }

        .cta-content {
            position: relative;
            overflow: hidden;
            transition: all 0.5s ease;
            box-shadow: 0 10px 30px rgba(255, 75, 43, 0.2);
        }

        .cta-content:hover {
            background: linear-gradient(45deg, #8f94fb, #4e54c8) !important;
            transform: scale(1.01);
            box-shadow: 0px 8px 30px rgba(78, 84, 200, 0.3);
        }

        /* Tombol Daftar Sekarang */
        .btn-register {
            display: inline-block;
            background: white;
            color: #ff4b2b;
            font-size: 16px;
            font-weight: 600;
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .btn-register:hover {
            background: #f8f9fa;
            color: #ff4b2b;
            transform: translateY(-3px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Tombol Kontak Kami */
        .btn-contact {
            display: inline-block;
            background: white;
            color: #ff4b2b;
            font-size: 16px;
            font-weight: 600;
            padding: 12px 25px;
            border: 2px solid white;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-contact:hover {
            background: #f8f9fa;
            color: #ff4b2b;
            transform: translateY(-3px);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        adow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
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
    <!-- CTA Section -->
    <section class="cta-section text-white">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="cta-content rounded-4 p-5" style="background: linear-gradient(45deg, #ff416c, #ff4b2b);">
                        <div class="row align-items-center">
                            <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                                <h2 class="mb-3">Siap Memulai Perjalanan Crypto Anda?</h2>
                                <p class="mb-0">Bergabunglah dengan ribuan anggota kami yang telah menemukan cara lebih
                                    cerdas
                                    berinvestasi di dunia cryptocurrency.</p>
                            </div>
                            <div class="col-lg-4 text-center text-lg-end">
                                <a href="{{ route('register') }}" class="btn-register me-2">
                                    <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                                </a>
                                <a href="{{ url('/kontak') }}" class="btn-contact mt-2">
                                    <i class="bi bi-envelope me-2"></i>Kontak Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End CTA Section -->
    <!--================ CTA Section End =================-->
@endsection

@push('styles')
@endpush
