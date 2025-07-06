@extends('layouts.app')
<!-- Menggunakan layout utama 'app' dari file layouts.app untuk menyusun struktur halaman ini -->

@section('title', 'Riwayat Pemeriksaan Pasien')
<!-- Menetapkan judul halaman di browser menjadi 'Riwayat Pemeriksaan Pasien' -->

@section('content')
    <!-- Bagian konten halaman utama -->

    <div class="container-fluid py-3">
        <!-- Kontainer utama dengan padding vertikal (py-3) untuk konten halaman -->

        <div class="app-content-header mb-4 mt-3">
            <!-- Header konten bagian atas dengan margin bawah dan atas -->
            <div class="container-fluid">
                <!-- Kontainer dalam untuk pengaturan responsif -->
                <div class="row">
                    <!-- Baris untuk menampilkan kolom header -->
                    <div class="col-sm-6">
                        <h3 class="mb-0">Riwayat Pemeriksaan Pasien: {{ $pasien->nama }}</h3>
                        <!-- Judul halaman yang menampilkan nama pasien -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <!-- Menampilkan breadcrumb untuk navigasi -->
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                            <!-- Tautan ke dashboard dokter -->
                            <li class="breadcrumb-item"><a href="{{ route('dokter.riwayat-periksa.index') }}">Daftar
                                    Pasien</a></li>
                            <!-- Tautan ke halaman daftar pasien -->
                            <li class="breadcrumb-item active" aria-current="page">Riwayat Pemeriksaan</li>
                            <!-- Menandakan halaman saat ini -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <!-- Kontainer utama untuk konten halaman -->

                <div class="row">
                    <!-- Baris untuk menampilkan tabel riwayat pemeriksaan pasien -->
                    <div class="col-lg-12">
                        <!-- Kolom untuk menampung card yang berisi tabel riwayat pemeriksaan -->
                        <div class="card">
                            <!-- Card untuk membungkus tabel -->
                            <div class="card-header">
                                <h4 class="card-title">Riwayat Pemeriksaan</h4>
                                <!-- Header card untuk menampilkan judul tabel -->
                            </div>
                            <div class="card-body">
                                <!-- Bagian tubuh card untuk menampilkan isi tabel -->
                                @if ($riwayat->isEmpty())
                                    <!-- Jika riwayat pemeriksaan kosong -->
                                    <p class="text-muted">Pasien belum pernah melakukan pemeriksaan.</p>
                                    <!-- Menampilkan pesan jika pasien belum melakukan pemeriksaan -->
                                @else
                                    <!-- Jika ada riwayat pemeriksaan, tampilkan tabel -->
                                    <table class="table table-striped table-bordered">
                                        <!-- Tabel untuk menampilkan riwayat pemeriksaan pasien -->
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Periksa</th>
                                                <th>Keluhan</th>
                                                <th>Catatan</th>
                                                <th>Biaya Pemeriksaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($riwayat as $key => $periksa)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <!-- Menampilkan nomor urut pemeriksaan -->
                                                    <td>{{ $periksa->tgl_periksa }}</td>
                                                    <!-- Menampilkan tanggal pemeriksaan -->
                                                    <td>{{ $periksa->janjiPeriksa->keluhan ?? 'Tidak ada keluhan' }}</td>
                                                    <!-- Menampilkan keluhan yang dikeluhkan pasien atau pesan default 'Tidak ada keluhan' -->
                                                    <td>{{ $periksa->catatan }}</td>
                                                    <!-- Menampilkan catatan pemeriksaan -->
                                                    <td>Rp. {{ number_format($periksa->biaya_periksa, 2) }}</td>
                                                    <!-- Menampilkan biaya pemeriksaan dengan format angka Rp dan 2 desimal -->
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Menutup bagian konten utama halaman -->
