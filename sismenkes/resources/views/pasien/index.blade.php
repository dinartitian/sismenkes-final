@extends('layouts.app')
<!-- Menggunakan layout utama 'app' yang ada di file layouts.app, menyediakan struktur dasar halaman seperti header, footer, dan sidebar -->

@section('title')
    PASIEN
@endsection
<!-- Menetapkan judul halaman yang ditampilkan pada tab browser menjadi "ADMIN" -->

@section('content')
    <!-- Bagian utama konten halaman -->

    <main class="app-main">
        <!-- Mulai bagian utama aplikasi -->

        <!-- App Content Header -->
        <div class="app-content-header">
            <!-- Header dari konten aplikasi untuk memberikan informasi bagian header pada halaman -->

            <div class="container-fluid">
                <!-- Kontainer utama yang memberikan lebar responsif dan padding -->

                <div class="row">
                    <!-- Baris untuk menyusun kolom-kolom di halaman -->

                    <div class="col-sm-6">
                        <!-- Kolom kiri yang menampilkan judul halaman -->
                        <h3 class="mb-0">Dashboard Pasien</h3>
                        <!-- Menampilkan judul halaman "Dashboard Pasien" -->
                    </div>

                    <div class="col-sm-6">
                        <!-- Kolom kanan yang menampilkan breadcrumb -->
                        <ol class="breadcrumb float-sm-end">
                            <!-- Daftar breadcrumb untuk navigasi -->
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <!-- Tautan menuju halaman Home -->
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            <!-- Menandakan halaman saat ini adalah "Dashboard" -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End App Content Header -->

        <!-- App Content -->
        <div class="app-content">
            <!-- Bagian utama konten aplikasi -->

            <div class="container-fluid">
                <!-- Kontainer untuk menjaga layout responsif -->

                <div class="row">
                    <!-- Baris yang berisi beberapa widget informasi -->

                    <div class="col-lg-3 col-6">
                        <!-- Kolom pertama yang menampilkan widget box untuk informasi "New Orders" -->
                        <div class="small-box text-bg-primary">
                            <!-- Box kecil dengan latar belakang biru -->
                            <div class="inner">
                                <h3>150</h3>
                                <!-- Menampilkan angka 150 untuk jumlah "New Orders" -->
                                <p>New Orders</p>
                                <!-- Label untuk menjelaskan isi widget -->
                            </div>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                                </path>
                            </svg>
                        </div>
                        <!-- End Small Box Widget 1 -->
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- Kolom kedua menampilkan widget box untuk informasi "Bounce Rate" -->
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                <h3>53<sup class="fs-5">%</sup></h3>
                                <!-- Menampilkan persentase 53% untuk "Bounce Rate" -->
                                <p>Bounce Rate</p>
                            </div>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z">
                                </path>
                            </svg>
                        </div>
                        <!-- End Small Box Widget 2 -->
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- Kolom ketiga menampilkan widget box untuk informasi "User Registrations" -->
                        <div class="small-box text-bg-warning">
                            <div class="inner">
                                <h3>44</h3>
                                <!-- Menampilkan angka 44 untuk jumlah "User Registrations" -->
                                <p>User Registrations</p>
                            </div>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                </path>
                            </svg>
                        </div>
                        <!-- End Small Box Widget 3 -->
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- Kolom keempat menampilkan widget box untuk informasi "Unique Visitors" -->
                        <div class="small-box text-bg-danger">
                            <div class="inner">
                                <h3>65</h3>
                                <!-- Menampilkan angka 65 untuk "Unique Visitors" -->
                                <p>Unique Visitors</p>
                            </div>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z">
                                </path>
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z">
                                </path>
                            </svg>
                        </div>
                        <!-- End Small Box Widget 4 -->
                    </div>

                </div>
                <!-- End Row -->
                <!-- Begin Main Content Row -->
                <div class="row">
                    <!-- Kolom utama untuk grafik -->
                    <div class="col-lg-12 connectedSortable">
                        <!-- Kolom penuh untuk grafik -->
                        <div class="card mb-4">
                            <!-- Card untuk menampilkan grafik -->
                            <div class="card-header">
                                <h3 class="card-title">Sales Value</h3>
                                <!-- Judul grafik -->
                            </div>
                            <div class="card-body">
                                <div id="revenue-chart"></div>
                                <!-- Placeholder untuk grafik, akan dimuat menggunakan JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Main Content Row -->
            </div>
        </div>
    </main>
    <!-- End App Main -->
@endsection
<!-- End Section Content -->
