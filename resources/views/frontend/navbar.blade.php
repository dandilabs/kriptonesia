<body class="index-page">

    <header id="header" class="header position-relative">
        <div class="container-fluid container-xl position-relative">

            <div class="top-row d-flex align-items-center justify-content-between">
                <a href="{{ url('/') }}" class="logo d-flex align-items-end">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.webp" alt=""> -->
                    <h1 class="sitename">Kriptonesia</h1><span>.</span>
                </a>

                <div class="d-flex align-items-center">
                    <div class="social-links">
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    </div>

                    <form class="search-form ms-4">
                        <input type="text" placeholder="Search..." class="form-control">
                        <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>

        </div>

        <div class="nav-wrap">
            <div class="container d-flex justify-content-center position-relative">
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li>
                            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a>
                        </li>
                        <li><a href="{{ route('blog.artikel') }}"
                                class="{{ Route::is('blog.artikel') ? 'active' : '' }}">Artikel</a></li>
                        <li class="nav-item position-relative">
                            <a href="{{ route('produk') }}" class="nav-link {{ route::is('produk') ? 'active' : '' }}">
                                Produk
                                <span class="badge-custom position-absolute top-0 start-100 translate-middle">🔥
                                    Limited</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/tentang-kami') }}"
                                class="{{ Request::is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a>
                        </li>
                        <li>
                            <a href="{{ url('/kontak') }}"
                                class="{{ Request::is('kontak') ? 'active' : '' }}">Kontak</a>
                        </li>
                        <li class="dropdown"><a href="#"><span>Membership</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                @guest
                                    @if (Route::has('login'))
                                        <li><a href="{{ route('login') }}">Masuk</a></li>
                                    @endif
                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}">Daftar</a></li>
                                    @endif
                                @else
                                    <li class="dropdown">
                                        <a href="#">
                                            <span>{{ Auth::user()->name }}</span>
                                            <i class="bi bi-chevron-down toggle-dropdown"></i>
                                        </a>
                                        @if (Auth::user()->role == 1)
                                            <ul>
                                                <li>
                                                    <a href="{{ url('/admin/home') }}"><i
                                                            class="nav-icon fas fa-tachometer-alt"></i> Dashboard Admin</a>
                                                </li>
                                            </ul>
                                        @elseif (Auth::check() && Auth::user()->payment_status === 'paid')
                                            <ul>
                                                <li>
                                                    <a href="{{ url('/member/home') }}"><i
                                                            class="nav-icon fas fa-user"></i> Dashboard Member</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('payment.history') }}"><i
                                                            class="nav-icon fas fa-history"></i> Riwayat Pembayaran</a>
                                                </li>
                                            </ul>
                                        @else
                                            @php
                                                $latestPayment = App\Models\PaymentConfirmation::where(
                                                    'user_id',
                                                    Auth::id(),
                                                )
                                                    ->orderBy('created_at', 'desc')
                                                    ->first();
                                            @endphp

                                            <ul>
                                                @if ($latestPayment)
                                                    @if ($latestPayment->status === 'verifying')
                                                        <li>
                                                            <i class="nav-icon fas fa-hourglass-half"></i> Pembayaran Sedang
                                                            Diverifikasi
                                                        </li>
                                                    @elseif($latestPayment->status === 'pending')
                                                        <li>
                                                            <a
                                                                href="{{ route('payment.confirm', ['user_id' => Auth::id(), 'payment_type' => $latestPayment->payment_type]) }}">
                                                                <i class="nav-icon fas fa-exclamation-triangle"></i>
                                                                Selesaikan Pembayaran
                                                            </a>
                                                        </li>
                                                    @elseif($latestPayment->status === 'expired')
                                                        <li>
                                                            <a href="{{ route('member.upgrade') }}">
                                                                <i class="nav-icon fas fa-shopping-cart"></i> Buat
                                                                Pembayaran Baru
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{ route('payment.history') }}"><i
                                                                class="nav-icon fas fa-history"></i> Riwayat Pembayaran</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ route('member.upgrade') }}"><i
                                                                class="nav-icon fas fa-shopping-cart"></i> Mulai
                                                            Berlangganan</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="nav-icon fas fa-sign-out-alt"></i> Logout</a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            @endguest
                        </li>
                    </ul>
                    </li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
                @include('sweetalert::alert')
            </div>
        </div>

    </header>
