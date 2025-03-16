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

    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-title">Tentang Kriptonesia</h2>
                    <p>
                        Kriptonesia adalah platform edukasi dan informasi yang berfokus pada cryptocurrency dan strategi trading.
                        Kami menyediakan berbagai artikel, panduan, serta analisis untuk membantu pengguna memahami dunia crypto
                        dengan lebih baik dan memaksimalkan strategi investasi mereka.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!--================ Visi & Misi Start =================-->
    <section class="vision-mission-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Visi</h3>
                    <p>
                        Menjadi platform edukasi cryptocurrency terdepan di Indonesia yang membantu para trader dan investor
                        memahami serta mengoptimalkan peluang di dunia digital aset.
                    </p>
                </div>
                <div class="col-lg-6">
                    <h3>Misi</h3>
                    <ul>
                        <li>Menyediakan informasi yang akurat, terpercaya, dan terkini tentang cryptocurrency.</li>
                        <li>Membantu pemula memahami dasar-dasar crypto melalui panduan yang mudah diikuti.</li>
                        <li>Menyajikan analisis dan strategi trading bagi para trader dan investor.</li>
                        <li>Membangun komunitas crypto yang solid dan edukatif.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--================ Visi & Misi End =================-->

    <!--================ Sejarah & Motivasi Start =================-->
    <section class="history-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-title">Sejarah & Motivasi</h2>
                    <p>
                        Kriptonesia lahir dari keinginan untuk menyediakan edukasi crypto yang mudah dipahami oleh semua orang,
                        terutama di Indonesia. Dengan semakin populernya aset digital, banyak orang yang ingin terjun ke dunia crypto
                        tetapi kurang memiliki pemahaman yang cukup. Oleh karena itu, kami hadir untuk memberikan panduan, strategi,
                        dan informasi yang bisa diandalkan dalam perjalanan investasi mereka.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--================ Sejarah & Motivasi End =================-->
@endsection
