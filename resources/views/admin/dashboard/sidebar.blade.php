<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="/admin/home" class="nav-link {{ request()->is('admin/home') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <!-- Content Management -->
        <li class="nav-header text-uppercase text-sm mt-2">MANAJEMEN KONTEN</li>

        <li class="nav-item">
            <a href="#" class="nav-link {{ request()->is('admin/post*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>
                    Manajemen Postingan
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('post.index') }}"
                        class="nav-link {{ request()->is('admin/post') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Semua Postingan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('post.trashed') }}"
                        class="nav-link {{ request()->is('admin/post/trashed') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Postingan Terhapus</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}"
                        class="nav-link {{ request()->is('admin/category') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tag.index') }}"
                        class="nav-link {{ request()->is('admin/tag') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tag</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Trading Section -->
        <li class="nav-header text-uppercase text-sm mt-2">TRADING</li>

        <li class="nav-item">
            <a href="#" class="nav-link {{ request()->is('admin/signal-trade*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>
                    Manajemen Trading
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('signal-trade.index') }}"
                        class="nav-link {{ request()->is('admin/signal-trade') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Signal Trading</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- User Management -->
        <li class="nav-header text-uppercase text-sm mt-2">MANAJEMEN USER</li>

        <li class="nav-item">
            <a href="#" class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                    Pengguna & Keanggotaan
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('user.index') }}"
                        class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daftar Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.payments') }}"
                        class="nav-link {{ request()->is('admin/payments') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Navigation -->
        <li class="nav-header text-uppercase text-sm mt-2">NAVIGASI</li>

        <li class="nav-item">
            <a href="/" class="nav-link" target="_blank">
                <i class="nav-icon fas fa-external-link-alt"></i>
                <p>Lihat Situs</p>
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
