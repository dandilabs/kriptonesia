@extends('template.index')
@section('title')
    Tentang Kami
@endsection

@section('content')
    <!--================ Hero sm banner start =================-->
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content">
                    <h1>Tentang Kami</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranca</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero sm banner end =================-->

    <!--================ Tentang Kriptonesia =================-->
    <section class="mb-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Tentang Kriptonesia</h2>
                    <p style="text-align: justify">Kriptonesia adalah tempat terbaik untuk memahami dunia
                        <strong>cryptocurrency</strong>,
                        baik bagi pemula yang baru ingin belajar maupun trader berpengalaman yang mencari strategi canggih.
                    </p>
                    <p style="text-align: justify">
                        Kami menyajikan <strong>artikel, panduan, analisis pasar, serta strategi trading</strong> yang dapat
                        membantu Anda
                        memahami peluang dan risiko di dunia aset digital. Dengan pendekatan yang sederhana dan mudah
                        dipahami, Kriptonesia hadir
                        untuk membimbing Anda mulai dari <strong>dasar-dasar crypto</strong> hingga <strong>teknik trading
                            profesional</strong>.
                    </p>
                    <p style="text-align: justify">
                        Di era digital ini, aset kripto semakin berkembang pesat. Tanpa edukasi yang tepat, banyak investor
                        dan trader yang
                        terjebak dalam keputusan impulsif. <strong>Misi kami adalah membangun komunitas yang cerdas,
                            memahami teknologi blockchain,
                            dan mampu mengambil keputusan investasi dengan percaya diri.</strong>
                    </p>
                    <p style="text-align: justify">
                        <strong>💡 Siap memulai perjalanan Anda di dunia crypto?</strong> Selamat datang di Kriptonesia,
                        tempat belajar crypto yang aman dan terpercaya!
                    </p>
                </div>
                <div class="col-lg-6 text-center" style="display: flex; justify-content: center; align-items: center;">
                    <img src="{{ asset('assets/img/tentangkami.png') }}" alt="Tentang Kriptonesia" class="img-fluid"
                        style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
                </div>
            </div>
        </div>
    </section>
    <!--================ End Tentang Kriptonesia =================-->

    <!--================ Visi & Misi =================-->
    <section class="vision-mission section-padding bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card p-4">
                        <h3>Visi</h3>
                        <p style="text-align: justify">Menjadi platform edukasi cryptocurrency terdepan di Indonesia yang
                            membantu para trader dan
                            investor memahami serta mengoptimalkan peluang di dunia digital aset.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card p-4">
                        <h3>Misi</h3>
                        <ul>
                            <li style="text-align: justify">Menyediakan informasi yang akurat, terpercaya, dan terkini
                                tentang cryptocurrency.</li>
                            <li style="text-align: justify">Membantu pemula memahami dasar-dasar crypto melalui panduan yang
                                mudah diikuti.</li>
                            <li style="text-align: justify">Menyajikan analisis dan strategi trading bagi para trader dan
                                investor.</li>
                            <li style="text-align: justify">Membangun komunitas crypto yang solid dan edukatif.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Visi & Misi =================-->

    <!--================ Sejarah & Motivasi =================-->
    <section style="margin-bottom: 40px;">
        <div class="container">
            <h2 class="text-center">Sejarah & Motivasi</h2>
            <p class="text-center" style="text-align: justify">Kriptonesia lahir dari keinginan untuk menyediakan edukasi
                crypto yang mudah dipahami
                oleh semua orang. Dengan semakin populernya aset digital, banyak orang yang ingin terjun ke dunia crypto
                tetapi kurang memiliki pemahaman yang cukup. Oleh karena itu, kami hadir untuk memberikan panduan, strategi,
                dan informasi yang bisa diandalkan dalam perjalanan investasi mereka.</p>
        </div>
    </section>
    <!--================ End Sejarah & Motivasi =================-->

    <!--================ Call to Action =================-->
    <section style="margin-top: 60px; text-align: center; margin-bottom: 10px;">
        <div class="container">
            <h2>Bergabung dengan Komunitas Kami!</h2>
            <p>Dapatkan informasi, strategi trading, dan analisis terbaru langsung dari para ahli.</p>
            <a href="membership.html" class="button button--active button-contactForm">Gabung Sekarang</a>
        </div>
    </section>
    <!--================ End Call to Action =================-->
@endsection
