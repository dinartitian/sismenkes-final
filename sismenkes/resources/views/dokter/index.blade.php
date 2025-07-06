@extends('layouts.app')
<!-- Menggunakan layout utama 'app' yang ada di file layouts.app, sehingga halaman ini mengikuti struktur dasar aplikasi yang sudah ditentukan, seperti header, footer, dan sidebar -->

@section('title')
    ADMIN
@endsection
<!-- Menetapkan judul halaman menjadi 'ADMIN' yang akan ditampilkan di tab browser -->

@section('content')
    <!-- Bagian utama konten halaman -->

    <!--begin::App Main-->
    <main class="app-main">
        <!-- Elemen utama untuk aplikasi, yang membungkus seluruh konten utama halaman -->

        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!-- Header untuk bagian konten utama aplikasi -->
            <div class="container-fluid">
                <!-- Kontainer untuk memastikan responsif pada layar -->
                <div class="row">
                    <!-- Baris untuk menampilkan kolom header -->
                    <div class="col-sm-6">
                        <h3 class="mb-0">Dashboard Dokter</h3>
                        <!-- Judul halaman, menampilkan 'Dashboard Dokter' -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <!-- Menampilkan breadcrumb untuk navigasi -->
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <!-- Tautan untuk navigasi ke halaman Home -->
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            <!-- Menandakan halaman saat ini, yang adalah Dashboard -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <!-- Bagian utama konten aplikasi -->
            <div class="container-fluid">
                <!-- Kontainer untuk memastikan responsif pada layar -->
                <div class="row">
                    <!-- Baris untuk menampilkan beberapa kolom widget -->

                    <!--begin::Col-->
                    <div class="col-lg-3 col-6">
                        <!-- Kolom pertama untuk menampilkan widget informasi -->
                        <div class="small-box text-bg-primary">
                            <!-- Widget box dengan background biru -->
                            <div class="inner">
                                <!-- Bagian dalam widget -->
                                <h3>150</h3>
                                <!-- Menampilkan angka (150) -->
                                <p>New Orders</p>
                                <!-- Deskripsi untuk angka yang ditampilkan -->
                            </div>
                            <!-- Ikon SVG di samping widget untuk mewakili 'New Orders' -->
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <!--end::Col-->

                    <!-- Repeat similar blocks for other widgets (Bounce Rate, User Registrations, Unique Visitors)-->
                    <div class="col-lg-3 col-6">
                        <!-- Widget untuk 'Bounce Rate' -->
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                <h3>53<sup class="fs-5">%</sup></h3>
                                <p>Bounce Rate</p>
                            </div>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- Widget untuk 'User Registrations' -->
                        <div class="small-box text-bg-warning">
                            <div class="inner">
                                <h3>44</h3>
                                <p>User Registrations</p>
                            </div>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- Widget untuk 'Unique Visitors' -->
                        <div class="small-box text-bg-danger">
                            <div class="inner">
                                <h3>65</h3>
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
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row">
                    <!-- Baris untuk menampilkan chart -->
                    <div class="col-lg-12 connectedSortable">
                        <div class="card mb-4">
                            <!-- Card untuk menampilkan grafik -->
                            <div class="card-header">
                                <h3 class="card-title">Sales Value</h3>
                            </div>
                            <div class="card-body">
                                <!-- Bagian grafik, menampilkan grafik dari elemen dengan id 'revenue-chart' -->
                                <div id="revenue-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection
