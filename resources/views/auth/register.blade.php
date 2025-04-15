@extends('frontend.index')

@section('title')
    Daftar Akun
@endsection

@section('content')
@include('sweetalert::alert')
    <style>
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
            transform: scale(1.05);
            box-shadow: 0px 8px 20px rgba(78, 84, 200, 0.5);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 0.25rem;
            padding: 0.75rem 1rem;
        }

        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            font-size: 1.5rem;
            font-weight: 600;
            padding: 1.5rem;
        }

        .card-body {
            padding: 2rem;
        }
    </style>

    <!-- Page Title -->
    <div class="page-title">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('register') }}">Daftar Akun</a></li>
                    <li class="breadcrumb-item active current">Membership</li>
                </ol>
            </nav>
        </div>

        <div class="title-wrapper">
            <h1>Membership</h1>
        </div>
    </div><!-- End Page Title -->

    <section id="membership" class="membership section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-wrapper" data-aos="fade-up" data-aos-delay="400">
                        <div class="card">
                            <div class="card-header">Daftar Membership</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}" role="form">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                <input id="name" type="text" class="form-control" name="name"
                                                    value="{{ old('name') }}" placeholder="Nama*" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                <input id="email" type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}" placeholder="Email*" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6 form-group">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                <input id="password" type="password" class="form-control" name="password"
                                                    placeholder="Password*" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" placeholder="Konfirmasi Password*"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-list"></i></span>
                                            <select id="membership" class="form-control" name="membership_type" required>
                                                <option value="free">Hanya Daftar</option>
                                                <optgroup label="Langganan News">
                                                    <option value="news_1hari">News - 1 Hari (Rp5.000)</option>
                                                    <option value="news_1bulan">News - 1 Bulan (Rp50.000)</option>
                                                    <option value="news_3bulan">News - 3 Bulan (Rp120.000)</option>
                                                    <option value="news_6bulan">News - 6 Bulan (Rp200.000)</option>
                                                    <option value="news_lifetime">News - Lifetime (Rp500.000)</option>
                                                </optgroup>
                                                <optgroup label="Membership Full Akses">
                                                    <option value="membership_1bulan">1 Bulan - Rp250.000</option>
                                                    <option value="membership_3bulan">3 Bulan - Rp500.000</option>
                                                    <option value="membership_6bulan">6 Bulan - Rp1.500.000</option>
                                                    <option value="membership_lifetime">Lifetime - Rp3.000.000</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="submit-btn">
                                            Daftar Sekarang
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
