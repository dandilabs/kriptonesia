<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @auth
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('member.home') }}" class="nav-link {{ request()->routeIs('member.home') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- News Package Menu -->
            @if (str_contains(Auth::user()->membership_type, 'news'))
                <li class="nav-item">
                    <a href="{{ route('crypto-news.index') }}"
                        class="nav-link {{ request()->routeIs('crypto-news.*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Crypto News</p>
                        <span class="right badge badge-info">NEW</span>
                    </a>
                </li>
            @endif

            <!-- Full Access Package Menu -->
            @if (str_contains(Auth::user()->membership_type, 'membership'))
                <!-- Trading Tools Submenu -->
                <li class="nav-item has-treeview {{ request()->routeIs('trade.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('trade.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Trading Tools
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('trade.index') }}"
                                class="nav-link {{ request()->routeIs('trade.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Signal Trading</p>
                                <span class="right badge badge-success">VIP</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('member.fear') }}"
                                class="nav-link {{ request()->routeIs('member.fear*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fear & Greed Index</p>
                                <span class="right badge badge-success">VIP</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('top.holdings', 'bitcoin') }}"
                                class="nav-link {{ request()->routeIs('top.holdings*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Holdings</p>
                                <span class="right badge badge-success">VIP</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Market Data Submenu -->
                <li
                    class="nav-item has-treeview {{ request()->routeIs('member.calendar*') || request()->routeIs('exchange-insight') || request()->routeIs('trending.crypto') || request()->routeIs('bitcoin-news.*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('member.calendar*') || request()->routeIs('exchange-insight') || request()->routeIs('trending.crypto') || request()->routeIs('bitcoin-news.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Market Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('member.calendar') }}"
                                class="nav-link {{ request()->routeIs('member.calendar*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kalender Ekonomi</p>
                                <span class="right badge badge-success">VIP</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('crypto-insight') }}"
                                class="nav-link {{ request()->routeIs('crypto-insight') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crypto Insight</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('trending.crypto') }}"
                                class="nav-link {{ request()->routeIs('trending.crypto') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Trending Cryptocurrencies</p>
                            </a>
                        </li>
                        <!-- Tambahan Crypto News -->
                        <li class="nav-item">
                            <a href="{{ route('crypto-news.index') }}"
                                class="nav-link {{ request()->routeIs('crypto-news.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crypto News</p>
                                <span class="right badge badge-info">NEW</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Community -->
                <li class="nav-item">
                    <a href="{{ route('member.community') }}"
                        class="nav-link {{ request()->routeIs('member.community') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Komunitas VIP</p>
                        <span class="right badge badge-success">VIP</span>
                    </a>
                </li>
            @endif

            <!-- Account Management -->
            <li class="nav-header">AKUN SAYA</li>
            <li class="nav-item">
                <a href="{{ route('payment.history') }}"
                    class="nav-link {{ request()->routeIs('payment.history') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-receipt"></i>
                    <p>Riwayat Pembayaran</p>
                </a>
            </li>

            <!-- Navigation -->
            <li class="nav-header">NAVIGASI</li>
            <li class="nav-item">
                <a href="/" class="nav-link bg-gradient-primary">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Beranda Kriptonesia</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="nav-link bg-gradient-danger">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Keluar</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endauth
    </ul>
</nav>
