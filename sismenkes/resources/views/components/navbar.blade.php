<nav class="app-header navbar navbar-expand bg-body">
    <!-- Navbar utama dengan kelas 'navbar' dan 'navbar-expand' agar navbar bisa responsif -->
    <!--bg-body digunakan untuk memberikan background warna sesuai tema-->

    <!--begin::Container-->
    <div class="container-fluid">
        <!-- Kontainer utama di dalam navbar untuk pengelompokan elemen-elemen navbar -->

        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <!-- Membuat daftar tautan navigasi dalam navbar -->

            <!-- Home Link -->
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <!-- Tautan untuk membuka sidebar dengan class data-lte-toggle="sidebar" yang mungkin digunakan untuk plugin atau fungsionalitas -->
                    <i class="bi bi-list"></i>
                    <!-- Ikon dengan kelas 'bi bi-list' untuk menu toggle sidebar -->
                </a>
            </li>

            <!-- Home Link (tampilkan hanya di layar yang lebih besar dari md) -->
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            <!-- Menggunakan kelas 'd-none d-md-block' untuk menyembunyikan tautan pada layar kecil (di bawah ukuran medium) -->

            <!-- Contact Link (tampilkan hanya di layar yang lebih besar dari md) -->
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
            <!-- Menyembunyikan link kontak pada ukuran layar kecil (di bawah ukuran medium) -->
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!-- Membuat daftar tautan navigasi di bagian kanan navbar dengan menggunakan kelas 'ms-auto' untuk memberikan margin otomatis ke kiri -->

            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <!-- Tombol untuk toggle fullscreen -->
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <!-- Ikon untuk masuk ke mode fullscreen -->
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                    <!-- Ikon untuk keluar dari fullscreen, disembunyikan pada awalnya -->
                </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <!-- Menampilkan dropdown dengan ikon gambar pengguna -->
                    <img src="{{ asset('adminlte/dist/assets/img/user2-160x160.jpg') }}"
                        class="user-image rounded-circle shadow" alt="User Image" />
                    <!-- Gambar profil pengguna, gambar default jika tidak ada profil khusus -->
                    <span class="d-none d-md-inline">Profile</span>
                    <!-- Menampilkan teks 'Profile' hanya pada layar medium dan lebih besar -->
                </a>
                <!-- Dropdown menu dengan daftar menu opsi pengguna -->
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!--begin::User Image-->
                    <li class="user-header text-bg-primary">
                        <img src="{{ asset('adminlte/dist/assets/img/user2-160x160.jpg') }}"
                            class="rounded-circle shadow" alt="User Image" />
                        <!-- Gambar profil di bagian header menu dropdown -->

                        <p>
                            <!-- Menampilkan nama pengguna berdasarkan guard yang aktif (admin, dokter, pasien, atau guest) -->
                            @if (Auth::guard('web')->check())
                                {{ Auth::user()->name }} - Admin
                            @elseif(Auth::guard('dokter')->check())
                                {{ Auth::guard('dokter')->user()->nama }} - Dokter
                            @elseif(Auth::guard('pasien')->check())
                                {{ Auth::guard('pasien')->user()->nama }} - Pasien
                            @else
                                Guest
                            @endif
                            <!-- Menampilkan nama pengguna sesuai dengan role yang login (admin, dokter, pasien, atau guest) -->
                        </p>
                    </li>
                    <!--end::User Image-->

                    <!--begin::Menu Footer-->
                    <li class="user-footer">
                        @auth('dokter')
                            <!-- Menampilkan link ke halaman profil dokter jika pengguna adalah dokter -->
                            <a href="{{ route('dokter.profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
                        @endauth

                        <!-- Form untuk logout -->
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            <!-- Form untuk logout yang mengarah ke route 'logout' -->
                            @csrf
                            <!-- Token CSRF untuk keamanan formulir logout -->
                            <button type="submit" class="btn btn-default btn-flat float-end">
                                <i class="fas fa-sign-out-alt me-1"></i> Sign out
                            </button>
                            <!-- Tombol untuk logout dengan ikon keluar dan teks 'Sign out' -->
                        </form>
                    </li>
                    <!--end::Menu Footer-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
