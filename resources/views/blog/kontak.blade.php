@extends('template.index')
@section('title')
    Kontak Kami | Hubungi Tim Kriptonesia
@endsection

@section('content')
    <!--================ Hero Banner Start =================-->
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content">
                    <h1>Hubungi Kami</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kontak</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero Banner End =================-->

    <!-- ================ Contact Section Start ================= -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="contact-info-wrapper">
                        <h2 class="mb-4">Informasi Kontak</h2>
                        <p class="mb-5">Tim support kami siap membantu Anda dari Senin hingga Jumat, pukul 08.00 - 17.00
                            WIB.</p>

                        <div class="contact-info-card shadow-sm bg-white p-4 rounded-lg mb-4">
                            <div class="d-flex">
                                <div class="contact-info-icon bg-primary-light rounded-circle mr-4">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-2">Lokasi Kantor</h5>
                                    <p class="mb-0">Tangerang Selatan, Banten<br>Indonesia</p>
                                </div>
                            </div>
                        </div>

                        <div class="contact-info-card shadow-sm bg-white p-4 rounded-lg mb-4">
                            <div class="d-flex">
                                <div class="contact-info-icon bg-primary-light rounded-circle mr-4">
                                    <i class="fa fa-phone text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-2">Nomor Telepon</h5>
                                    <p class="mb-1"><a href="tel:+6289699451818" class="text-dark">(+62) 896 9945 1818</a>
                                    </p>
                                    <small class="text-muted">Senin-Jumat, 08.00-17.00 WIB</small>
                                </div>
                            </div>
                        </div>

                        <div class="contact-info-card shadow-sm bg-white p-4 rounded-lg">
                            <div class="d-flex">
                                <div class="contact-info-icon bg-primary-light rounded-circle mr-4">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-2">Email Support</h5>
                                    <p class="mb-1"><a href="mailto:support@kriptonesia.com"
                                            class="text-dark">support@kriptonesia.com</a></p>
                                    <small class="text-muted">Respon dalam 1-2 hari kerja</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-form-wrapper bg-white shadow-sm rounded-lg p-5">
                        <h2 class="mb-4">Kirim Pesan</h2>
                        <p class="mb-4">Isi formulir berikut dan kami akan segera menghubungi Anda.</p>

                        <form id="contactForm" method="POST" action="#">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="email" class="form-label">Alamat Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="phone" class="form-label">Nomor WhatsApp</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="subject" class="form-label">Subjek</label>
                                <select class="form-control" id="subject" name="subject" required>
                                    <option value="" selected disabled>Pilih subjek</option>
                                    <option value="Pertanyaan Umum">Pertanyaan Umum</option>
                                    <option value="Bantuan Teknis">Bantuan Teknis</option>
                                    <option value="Kerjasama Bisnis">Kerjasama Bisnis</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="message" class="form-label">Pesan Anda</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ Contact Section End ================= -->

    <!-- ================ Map Section Start ================= -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="mb-3">Lokasi Kami</h2>
                <div class="title-border mx-auto"></div>
            </div>

            <div class="embed-responsive embed-responsive-16by9 rounded-lg shadow-sm">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.81916135000001!3d-6.194741999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTEnNDEuMSJTIDEwNsKwNDknMDkuMCJF!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    class="embed-responsive-item">
                </iframe>
            </div>
        </div>
    </section>
    <!-- ================ Map Section End ================= -->
@endsection

@push('styles')
    <style>
        /* Contact Info Card */
        .contact-info-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .contact-info-card {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .contact-info-card:hover {
            transform: translateY(-5px);
            border-left-color: #667eea;
        }

        /* Form Styles */
        .contact-form-wrapper {
            background-color: #fff;
        }

        .form-control {
            border-radius: 4px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        /* Button */
        .btn-primary {
            background-color: #667eea;
            border-color: #667eea;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #5a6fd1;
            border-color: #5a6fd1;
            transform: translateY(-2px);
        }

        /* Map */
        .embed-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
    </style>
@endpush
