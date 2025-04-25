<footer class="footer-area section-padding">
    <div class="container">
        <div class="row">
            <!-- About Us -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Tentang Kami</h6>
                    <p>
                        Kami menyediakan berita terbaru, analisis, dan strategi trading cryptocurrency untuk membantu
                        Anda mengambil keputusan yang lebih baik dalam dunia aset digital.
                    </p>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Berlangganan Berita</h6>
                    <p>Dapatkan update terkini seputar crypto & strategi trading</p>
                    <div id="mc_embed_signup">
                        <form target="_blank" novalidate="true"
                            action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                            method="get" class="form-inline">
                            <div class="d-flex flex-row">
                                <input class="form-control" name="EMAIL" placeholder="Masukkan Email Anda"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Email Anda'"
                                    required="" type="email">
                                <button class="click-btn btn btn-default">
                                    <span class="lnr lnr-arrow-right"></span>
                                </button>
                            </div>
                            <div class="info"></div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Crypto Resources (Pengganti Instagram Feed) -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Crypto Resources</h6>
                    <ul>
                        <li><a href="#">Coin Market Cap</a></li>
                        <li><a href="#">TradingView</a></li>
                        <li><a href="#">Crypto News</a></li>
                        <li><a href="#">Blockchain Explorer</a></li>
                    </ul>
                </div>
            </div>

            <!-- Follow Us -->
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Ikuti Kami</h6>
                    <p>Temukan kami di:</p>
                    <div class="footer-social d-flex align-items-center">
                        <a href="#"><i class="fab fa-telegram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
            <p class="footer-text m-0">
                Copyright &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script>
                Kriptonesia - Semua hak dilindungi.
            </p>
        </div>
    </div>
</footer>



<script src="{{ asset('assets/vendors/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('assets/js/mail-script.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@stack('js')
<script>
    setTimeout(function() {
        $(".alert").fadeOut("slow");
    }, 3000); // 3 detik
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let timeLeft = 300;
        const timerDisplay = document.getElementById('payment-timer');

        function updateTimer() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            timerDisplay.innerHTML =
                `Selesaikan pembayaran dalam ${minutes}:${seconds < 10 ? '0' : ''}${seconds} menit`;
            if (timeLeft > 0) {
                timeLeft--;
                setTimeout(updateTimer, 1000);
            } else {
                window.location.href = "{{ route('payment.history') }}";
            }
        }
        updateTimer();
    });
</script>
<script>
    // Pastikan Font Awesome terload
    document.addEventListener('DOMContentLoaded', function() {
        if(typeof FontAwesome === 'undefined') {
            const faScript = document.createElement('script');
            faScript.src = 'https://kit.fontawesome.com/a076d05399.js';
            document.head.appendChild(faScript);
        }
    });
</script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
</body>

</html>
