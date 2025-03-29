<footer id="footer" class="footer">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                    <span class="sitename">Kriptonesia</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>Platform edukasi cryptocurrency terkemuka di Indonesia yang menyediakan analisis pasar, strategi
                        trading, dan pengetahuan blockchain.</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>+62 896 9955 1717</span></p>
                    <p><strong>Email:</strong> <span>info@kriptonesia.com</span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ route('blog.artikel') }}">Artikel</a></li>
                    <li><a href="{{ url('/produk') }}">Produk</a></li>
                    <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                    <li><a href="{{ url('/kontak') }}">Kontak</a></li>
                    <li><a href="{{ route('register') }}">Membership</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-3 footer-links">
                <h4>Layanan Kami</h4>
                <ul>
                    <li><a href="#">Analisis Pasar Harian</a></li>
                    <li><a href="#">Kursus Trading Crypto</a></li>
                    <li><a href="#">Sinyal Trading Premium</a></li>
                    <li><a href="#">Konsultasi Privat</a></li>
                    <li><a href="#">Komunitas Eksklusif</a></li>
                </ul>
            </div>

            {{-- <div class="col-lg-3 col-md-6 footer-newsletter">
                <h4>Newsletter</h4>
                <p>Dapatkan update terbaru seputar cryptocurrency langsung ke email Anda</p>
                <form action="#" method="post">
                    <input type="email" name="email" placeholder="Email Anda" class="form-control mb-2">
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div> --}}
        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>&copy;
            <script>
                document.write(new Date().getFullYear())
            </script> <strong>Kriptonesia</strong>. Semua Hak Dilindungi
        </p>
        <div class="credits">
            Designed by <a href="#">Kriptonesia Team</a>
        </div>
    </div>
</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>
@stack('js')


</body>

</html>
