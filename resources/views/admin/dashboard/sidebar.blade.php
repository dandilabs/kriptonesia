<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="/admin/home" class="nav-link {{ request()->is('admin/home') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <!-- Divider -->
        <li class="nav-header text-uppercase text-sm mt-2"><i class="fas fa-cog mr-1"></i> MANAJEMEN KONTEN</li>

        <!-- Content Management -->
        <li
            class="nav-item {{ request()->is('admin/post*') || request()->is('admin/category*') || request()->is('admin/tag*') ? 'menu-open' : '' }}">
            <a href="#"
                class="nav-link {{ request()->is('admin/post*') || request()->is('admin/category*') || request()->is('admin/tag*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>
                    Konten Artikel
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('post.index') }}"
                        class="nav-link {{ request()->is('admin/post') ? 'active' : '' }}">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>Semua Artikel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('post.trashed') }}"
                        class="nav-link {{ request()->is('admin/post/trashed') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-trash-restore"></i>
                        <p>Artikel Terhapus</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}"
                        class="nav-link {{ request()->is('admin/category') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tag.index') }}"
                        class="nav-link {{ request()->is('admin/tag') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Tag</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Divider -->
        <li class="nav-header text-uppercase text-sm mt-2"><i class="fas fa-chart-line mr-1"></i> TRADING</li>

        <!-- Trading Management -->
        <li class="nav-item {{ request()->is('admin/signal-trade*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/signal-trade*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                    Analisis Trading
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('signal-trade.index') }}"
                        class="nav-link {{ request()->is('admin/signal-trade') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-signal"></i>
                        <p>Signal Trading</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Riwayat Trading</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Divider -->
        <li class="nav-header text-uppercase text-sm mt-2"><i class="fas fa-users-cog mr-1"></i> MANAJEMEN USER</li>

        <!-- User Management -->
        <li class="nav-item {{ request()->is('admin/user*') || request()->is('admin/payments*') ? 'menu-open' : '' }}">
            <a href="#"
                class="nav-link {{ request()->is('admin/user*') || request()->is('admin/payments*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    Pengguna & Akses
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('user.index') }}"
                        class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Daftar Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.payments') }}"
                        class="nav-link {{ request()->is('admin/payments') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Transaksi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-clock"></i>
                        <p>Aktivitas Pengguna</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Product Management -->
        <li class="nav-item">
            <a href="{{ route('products.index') }}"
                class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-boxes"></i>
                <p>Paket Membership</p>
            </a>
        </li>

        <!-- Divider -->
        <li class="nav-header text-uppercase text-sm mt-2"><i class="fas fa-link mr-1"></i> NAVIGASI</li>

        <!-- Quick Links -->
        <li class="nav-item">
            <a href="/" class="nav-link" target="_blank">
                <i class="nav-icon fas fa-external-link-alt"></i>
                <p>Lihat Situs</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#"
                class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Pengaturan</p>
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
    </ul>
</nav>
