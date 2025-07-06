@extends('layouts.app')
<!-- Menggunakan layout utama 'app' yang ada di file layouts.app untuk struktur halaman ini -->

@section('title', 'Jadwal Memeriksa Pasien')
<!-- Menetapkan judul halaman di browser menjadi 'Jadwal Memeriksa Pasien' -->

@section('content')
    <!-- Bagian konten halaman utama -->

    <main class="app-main">
        <!-- Bagian utama aplikasi yang membungkus seluruh konten utama halaman -->

        <div class="app-content-header">
            <!-- Header bagian konten untuk menampilkan judul dan breadcrumb -->
            <div class="container-fluid">
                <!-- Kontainer untuk memastikan responsif pada layar -->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Jadwal Memeriksa Pasien</h3>
                        <!-- Menampilkan judul halaman -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <!-- Menampilkan breadcrumb untuk navigasi -->
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                            <!-- Tautan ke dashboard dokter -->
                            <li class="breadcrumb-item active" aria-current="page">Jadwal Memeriksa</li>
                            <!-- Menandakan halaman saat ini -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <!-- Kontainer utama untuk konten halaman -->

                <!-- Menampilkan Toast Alert jika ada pesan success -->
                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: '{{ session('success') }}',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                @endif
                <!-- Jika ada pesan sukses yang disimpan dalam session, tampilkan SweetAlert2 toast sukses -->

                <!-- Menampilkan Toast Alert jika ada pesan error -->
                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: '{{ session('error') }}',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                @endif
                <!-- Jika ada pesan error yang disimpan dalam session, tampilkan SweetAlert2 toast error -->

                <div class="row">
                    <!-- Baris untuk menampilkan konten utama halaman -->
                    <div class="col-lg-12">
                        <!-- Kolom yang menampung card untuk daftar pasien -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Pasien untuk Diperiksa</h4>
                                <!-- Header card untuk menampilkan judul tabel -->
                            </div>
                            <div class="card-body">
                                <!-- Bagian isi card untuk menampilkan tabel -->
                                <div class="table-responsive">
                                    <!-- Membungkus tabel dalam elemen responsif -->
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <!-- Tabel untuk menampilkan daftar pasien yang menunggu pemeriksaan -->
                                        <thead>
                                            <tr>
                                                <th>No Urut</th>
                                                <th>Nama Pasien</th>
                                                <th>Keluhan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($daftarPoli as $index => $daftar)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $daftar->pasien->nama }}</td>
                                                    <td>{{ $daftar->keluhan }}</td>
                                                    <td>
                                                        <!-- Menampilkan status apakah pasien sudah diperiksa atau belum -->
                                                        @if ($daftar->periksas->count() > 0)
                                                            <span class="badge bg-success">Sudah Diperiksa</span>
                                                        @else
                                                            <span class="badge bg-warning">Belum Diperiksa</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <!-- Menampilkan aksi tergantung status pemeriksaan pasien -->
                                                        @if ($daftar->periksas->count() > 0)
                                                            <!-- Tampilkan tombol Edit jika sudah diperiksa -->
                                                            <a href="{{ route('dokter.memeriksa.edit', $daftar->periksas->first()->id) }}"
                                                                class="btn btn-warning btn-sm">
                                                                <i class="bi bi-pencil"></i> Edit
                                                            </a>
                                                        @else
                                                            <!-- Tampilkan tombol Periksa jika belum diperiksa -->
                                                            <a href="{{ route('dokter.memeriksa.show', $daftar->id) }}"
                                                                class="btn btn-info btn-sm">
                                                                <i class="bi bi-eye"></i> Periksa
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
<!-- Menutup bagian konten halaman utama -->
