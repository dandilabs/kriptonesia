@extends('template.index')

@section('title', 'Produk')

@section('content')
    <!--================Hero Banner start =================-->
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content">
                    <h1>Produk Kriptonesia</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Produk</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <style>
            .table th,
            .table td {
                vertical-align: middle;
            }

            .table td {
                font-size: 16px;
            }

            .btn-custom {
                font-size: 16px;
                font-weight: bold;
                padding: 10px 20px;
                width: 100%;
            }
        </style>

        <div class="text-center mb-4">
            <h2>💡 Pilih Paket yang Sesuai dengan Kebutuhan Anda!</h2>
            <p class="text-muted">Dapatkan informasi terbaru, strategi, dan sinyal trading terbaik dari Kriptonesia.</p>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Fitur</th>
                        <th>News 🔥</th>
                        <th>Full Akses 🚀</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Akses Berita Eksklusif</td>
                        <td>✅</td>
                        <td>✅</td>
                    </tr>
                    <tr>
                        <td>Strategi Trading</td>
                        <td>❌</td>
                        <td>✅</td>
                    </tr>
                    <tr>
                        <td>Belajar Technical & Fundamental</td>
                        <td>❌</td>
                        <td>✅</td>
                    </tr>
                    <tr>
                        <td>Sinyal Trading</td>
                        <td>❌</td>
                        <td>✅</td>
                    </tr>
                    <tr>
                        <td>Akses ke Data Sentimen Pasar</td>
                        <td>✅</td>
                        <td>✅</td>
                    </tr>
                    <tr>
                        <td>Analisis On-Chain</td>
                        <td>❌</td>
                        <td>✅</td>
                    </tr>
                    <tr>
                        <td>Panduan Eksklusif</td>
                        <td>❌</td>
                        <td>✅</td>
                    </tr>
                    <tr>
                        <td>Grup Komunitas VIP</td>
                        <td>❌</td>
                        <td>✅</td>
                    </tr>
                    <tr>
                        <td>Airdrop</td>
                        <td>✅</td>
                        <td>✅</td>
                    </tr>
                    <tr>
                        <td>Support & Konsultasi</td>
                        <td>❌</td>
                        <td>✅</td>
                    </tr>
                    <tr>
                        <td><strong>Harga</strong></td>
                        <td><span class="text-success font-weight-bold">Rp xx.xxx</span></td>
                        <td><span class="text-danger font-weight-bold">Rp xx.xxx</span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-custom">Pilih News 🔥</a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger btn-custom">Pilih Full Akses 🚀</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
