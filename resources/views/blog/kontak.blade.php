@extends('frontend.index')

@section('title')
    Kontak Kami | Hubungi Tim Kriptonesia
@endsection

@section('content')
    <style>
        .contact-info-card {
            transition: all 0.3s ease;
        }

        .contact-info-card:hover {
            transform: translateY(-5px);
        }

        .submit-btn {
            display: inline-block;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 5px 15px rgba(255, 75, 43, 0.3);
        }

        .submit-btn:hover {
            background: linear-gradient(45deg, #8f94fb, #4e54c8);
            transform: translateY(-2px);
        }

        .map-container {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
    </style>

    <!-- Page Title -->
    <div class="page-title">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a></li>
                    <li class="breadcrumb-item active current">Kontak</li>
                </ol>
            </nav>
        </div>

        <div class="title-wrapper">
            <h1>Hubungi Kami</h1>
            <p>Tim support kami siap membantu Anda dari Senin hingga Jumat, pukul 08.00 - 17.00 WIB.</p>
        </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 mb-5">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-card contact-info-card">
                        <div class="icon-box">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h3>Lokasi Kantor</h3>
                        <p>Tangerang Selatan, Banten<br>Indonesia</p>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="info-card contact-info-card">
                        <div class="icon-box">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <h3>Nomor Telepon</h3>
                        <p><a href="tel:+6289699451818">(+62) 896 9945 1818</a><br>
                            <small>Senin-Jumat, 08.00-17.00 WIB</small>
                        </p>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="info-card contact-info-card">
                        <div class="icon-box">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <h3>Email Support</h3>
                        <p><a href="mailto:support@kriptonesia.com">support@kriptonesia.com</a><br>
                            <small>Respon dalam 1-2 hari kerja</small>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="form-wrapper">
                        <h2 class="mb-4">Kirim Pesan</h2>
                        <p class="mb-4">Isi formulir berikut dan kami akan segera menghubungi Anda.</p>

                        <form action="#" method="post" role="form" class="php-email-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Nama Lengkap*" required>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" name="email" placeholder="Email*"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                    <input type="tel" class="form-control" name="phone" placeholder="Nomor WhatsApp*"
                                        required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-list"></i></span>
                                    <select name="subject" class="form-control" required>
                                        <option value="" selected disabled>Pilih subjek*</option>
                                        <option value="Pertanyaan Umum">Pertanyaan Umum</option>
                                        <option value="Bantuan Teknis">Bantuan Teknis</option>
                                        <option value="Kerjasama Bisnis">Kerjasama Bisnis</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-chat-dots"></i></span>
                                    <textarea class="form-control" name="message" rows="6" placeholder="Pesan Anda*" required></textarea>
                                </div>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Pesan Anda telah terkirim. Terima kasih!</div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="submit-btn">
                                    <i class="bi bi-send-fill mr-2"></i> Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="map-container mt-lg-0">
                        <h2 class="mb-4">Lokasi Kami</h2>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.81916135000001!3d-6.194741999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTEnNDEuMSJTIDEwNsKwNDknMDkuMCJF!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Contact Section -->
@endsection
