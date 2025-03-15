<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kriptonesia - Home</title>
    <link rel="icon" href="{{ asset('assets/img/Fevicon.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }} ">
</head>

<body>
    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container box_1620">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ url('/') }}"><img src="{{ asset('assets/img/kriptonesia.png') }}"
                            alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav justify-content-center">
                            <li class="nav-item active"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                            <li class="nav-item"><a class="nav-link" href="archive.html">Artikel</a></li>
                            <li class="nav-item"><a class="nav-link" href="category.html">Panduan & Strategi</a>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Tentang Kami</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Kontak</a></li>
                            {{-- <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Membership</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="blog-details.html">Masuk</a></li>
                                    <li class="nav-item"><a class="nav-link" href="blog-details.html">Daftar</a></li>
                                </ul>
                            </li> --}}
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Membership</a>
                                <ul class="dropdown-menu">
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Masuk</a></li>
                                        @endif
                                        @if (Route::has('register'))
                                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Daftar</a></li>
                                        @endif
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                {{ Auth::user()->name }}
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <!-- Cek role user -->
                                                @if (Auth::user()->role == 1) <!-- Admin -->
                                                    <a class="dropdown-item" href="{{ url('/admin/home') }}">
                                                        <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard Admin
                                                    </a>
                                                    @elseif (Auth::user()->role == 0) <!-- Member -->
                                                    <a class="dropdown-item" href="{{ url('/member/home') }}">
                                                        <i class="nav-icon fas fa-user"></i> Dashboard Member
                                                    </a>
                                                @endif
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="nav-icon fas fa-sign-out-alt"></i> Logout
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right navbar-social">
                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                            <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                            <li><a href="#"><i class="ti-instagram"></i></a></li>
                            <li><a href="#"><i class="ti-skype"></i></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Menu Area =================-->
