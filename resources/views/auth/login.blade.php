@extends('frontend.index')

@section('title')
    Masuk Akun
@endsection

@section('content')
    <style>
        .login-btn {
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

        .login-btn:hover {
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

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .is-invalid {
            border-color: #dc3545;
        }
    </style>

    <!-- Page Title -->
    <div class="page-title">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a></li>
                    <li class="breadcrumb-item active current">Masuk</li>
                </ol>
            </nav>
        </div>

        <div class="title-wrapper">
            <h1>Masuk Akun</h1>
        </div>
    </div><!-- End Page Title -->

    <section id="login" class="login section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-wrapper" data-aos="fade-up" data-aos-delay="400">
                        <div class="card">
                            <div class="card-header">Masuk ke Akun Anda</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}" role="form">
                                    @csrf

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" placeholder="Alamat Email*" required
                                                autocomplete="email" autofocus>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                placeholder="Password*" required autocomplete="current-password">
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                Ingat Saya
                                            </label>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="login-btn">
                                            Masuk
                                        </button>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <div class="text-center mt-3">
                                            <a href="{{ route('password.request') }}" class="text-decoration-none">
                                                Lupa Password?
                                            </a>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
