<aside class="app-sidebar bg-primary shadow" data-bs-theme="dark">
    <!-- Sidebar utama dengan tema biru, menggunakan kelas 'bg-primary' dan 'shadow' untuk memberi efek bayangan -->

    <!-- Sidebar Brand (Logo dan Nama Brand) -->
    <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
            <!-- Link yang mengarah ke halaman utama (index) dengan logo dan nama brand -->
            <img src="{{ asset('adminlte/dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!-- Logo brand yang akan ditampilkan di sidebar -->
            <span class="brand-text fw-light">SISMENKES</span>
            <!-- Nama brand yang ditampilkan di samping logo -->
        </a>
    </div>

    <!-- Sidebar Wrapper (Tempat elemen-elemen sidebar berada) -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-- Daftar menu sidebar -->
                <!-- Menu dashboard -->
                <li class="nav-item">
                    <a href="
        @if (auth()->guard('web')->check()) {{ route('admin.dashboard') }}
        @elseif(auth()->guard('dokter')->check())
            {{ route('dokter.dashboard') }}
        @elseif(auth()->guard('pasien')->check())
            {{ route('pasien.dashboard') }}
        @else
            {{ url('/') }} @endif
    "
                        class="nav-link {{ request()->is('admin/dashboard') || request()->is('dokter/dashboard') || request()->is('pasien/dashboard') ? 'active' : '' }}">
                        <!-- Menentukan route tujuan berdasarkan role pengguna yang sedang login -->
                        <!-- Jika admin, dokter, atau pasien yang login, arahkan ke dashboard yang sesuai -->
                        <i class="nav-icon bi bi-speedometer"></i>
                        <!-- Ikon untuk menu dashboard -->
                        <p>
                            Dashboards
                            @if (auth()->guard('pasien')->check())
                                <span class="right badge bg-danger">Pasien</span>
                            @elseif(auth()->guard('dokter')->check())
                                <span class="right badge bg-success">Dokter</span>
                            @elseif(auth()->guard('web')->check())
                                <span class="right badge bg-primary">Admin</span>
                            @endif
                        </p>
                        <!-- Badge yang menampilkan jenis user yang sedang login (Pasien, Dokter, atau Admin) -->
                    </a>
                </li>

                <!-- Hanya tampilkan menu "Master Data" jika admin yang login -->
                <li class="nav-header">
                    Master Data
                </li>
                @auth('web')
                    <!-- Jika pengguna yang login adalah admin -->
                    <!-- Menu Dokter -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dokter.index') }}"
                            class="nav-link {{ request()->is('admin/dokter*') ? 'active' : '' }}">
                            <!-- Menu Dokter, menampilkan daftar dokter -->
                            <i class="nav-icon bi bi-person-badge"></i>
                            <p>Dokter</p>
                        </a>
                    </li>

                    <!-- Menu Pasien -->
                    <li class="nav-item">
                        <a href="{{ route('admin.pasien.index') }}"
                            class="nav-link {{ request()->is('admin/pasien*') ? 'active' : '' }}">
                            <!-- Menu Pasien, menampilkan daftar pasien -->
                            <i class="nav-icon bi bi-people"></i>
                            <p>Pasien</p>
                        </a>
                    </li>

                    <!-- Menu Poli -->
                    <li class="nav-item">
                        <a href="{{ route('admin.poli.index') }}"
                            class="nav-link {{ request()->is('admin/poli*') ? 'active' : '' }}">
                            <!-- Menu Poli, menampilkan daftar poli -->
                            <i class="nav-icon bi bi-hospital"></i>
                            <p>Poli</p>
                        </a>
                    </li>
                    <!-- Menu Obat -->
                    <li class="nav-item">
                        <a href="{{ route('admin.obat.index') }}"
                            class="nav-link {{ request()->is('admin/obat*') ? 'active' : '' }}">
                            <!-- Menu Obat, menampilkan daftar obat -->
                            <i class="nav-icon bi bi-capsule-pill"></i>
                            <p>Obat</p>
                        </a>
                    </li>
                @endauth

                @auth('dokter')
                    <!-- Jika pengguna yang login adalah dokter -->
                    <!-- Menu khusus untuk dokter -->
                    <li class="nav-item">
                        <a href="{{ route('dokter.jadwal.index') }}"
                            class="nav-link {{ request()->is('dokter/jadwal*') ? 'active' : '' }}">
                            <!-- Menu Jadwal Periksa Dokter -->
                            <i class="nav-icon bi bi-calendar3"></i>
                            <p>Jadwal Periksa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dokter.memeriksa.index') }}"
                            class="nav-link {{ request()->is('dokter/memeriksa*') ? 'active' : '' }}">
                            <!-- Menu Memeriksa Pasien -->
                            <i class="nav-icon bi bi-person-hearts"></i>
                            <p>Memeriksa pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dokter.riwayat-periksa.index') }}"
                            class="nav-link {{ request()->is('dokter/riwayat*') ? 'active' : '' }}">
                            <!-- Menu Riwayat Periksa Dokter -->
                            <i class="nav-icon bi bi-arrow-clockwise"></i>
                            <p>Riwayat Periksa</p>
                        </a>
                    </li>
                @endauth

                @auth('pasien')
                    <!-- Jika pengguna yang login adalah pasien -->
                    <!-- Menu khusus untuk pasien -->
                    <li class="nav-item">
                        <a href="{{ route('pasien.daftar-poli.index') }}"
                            class="nav-link {{ request()->is('pasien/booking*') ? 'active' : '' }}">
                            <!-- Menu Daftar Poli untuk pasien -->
                            <i class="nav-icon bi bi-clipboard2-plus-fill"></i>
                            <p>Daftar Poli</p>
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>
</aside>

