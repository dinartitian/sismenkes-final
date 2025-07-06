@extends('layouts.app')
<!-- Menggunakan layout utama 'app' yang ada di file layouts.app untuk menyusun struktur dasar halaman, termasuk header, footer, dan sidebar -->

@section('title', 'Riwayat Pemeriksaan')
<!-- Menetapkan judul halaman menjadi 'Riwayat Pemeriksaan' yang akan ditampilkan di tab browser -->

@section('content')
    <!-- Bagian utama konten halaman -->

    <div class="container-fluid py-3">
        <!-- Kontainer utama dengan padding vertikal untuk menambah ruang antara elemen dan tepi halaman -->

        <div class="app-content-header mb-4 mt-3">
            <!-- Header bagian konten dengan margin bawah dan atas -->
            <div class="container-fluid">
                <!-- Kontainer dalam untuk pengaturan responsif -->
                <div class="row">
                    <!-- Baris untuk menampilkan kolom header dan breadcrumb -->
                    <div class="col-sm-6">
                        <h3 class="mb-0">Riwayat Pemeriksaan</h3>
                        <!-- Menampilkan judul halaman 'Riwayat Pemeriksaan' -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <!-- Menampilkan breadcrumb untuk navigasi halaman -->
                            <li class="breadcrumb-item"><a href="{{ route('pasien.dashboard') }}">Home</a></li>
                            <!-- Tautan ke halaman Home -->
                            <li class="breadcrumb-item"><a href="{{ route('pasien.daftar-poli.index') }}">Daftar Poli</a>
                            </li>
                            <!-- Tautan ke halaman Daftar Poli -->
                            <li class="breadcrumb-item active" aria-current="page">Riwayat Pemeriksaan</li>
                            <!-- Menandakan halaman saat ini adalah 'Riwayat Pemeriksaan' -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Baris utama untuk menampilkan card dengan riwayat pemeriksaan pasien -->
            <div class="col-md-12">
                <!-- Kolom untuk menampilkan konten card riwayat pemeriksaan -->
                <div class="card shadow-sm">
                    <!-- Card dengan bayangan ringan -->
                    <div class="card-header" style="background-color: #007BFF; color: #ffffff;">
                        <!-- Header card dengan latar belakang biru dan teks putih -->
                        <h5 class="card-title mb-0">Riwayat Pemeriksaan</h5>
                        <!-- Judul card -->
                    </div>
                    <div class="card-body">
                        <!-- Bagian tubuh card yang berisi informasi riwayat pemeriksaan -->

                        <!-- Cek apakah pasien memiliki riwayat pemeriksaan -->
                        @if ($data->periksas->count() > 0)
                            <!-- Jika ada pemeriksaan yang terdaftar -->
                            <div class="mb-4 border-2 card">
                                <!-- Card untuk detail pemeriksaan -->
                                <div class="bg-white card-header border-bottom">
                                    <h5 class="mb-0 font-semibold text-gray-800 card-title">Detail Pemeriksaan</h5>
                                    <!-- Header untuk bagian detail pemeriksaan -->
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Baris untuk menampilkan detail pemeriksaan -->
                                        <div class="col-md-6">
                                            <label class="font-semibold text-gray-700 form-label">Tanggal
                                                Pemeriksaan</label>
                                            <div class="form-control-plaintext">
                                                <!-- Menampilkan tanggal pemeriksaan -->
                                                {{ \Carbon\Carbon::parse($data->periksas->first()->tgl_periksa)->translatedFormat('d F Y H:i') }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="font-semibold text-gray-700 form-label">Catatan
                                                Pemeriksaan</label>
                                            <div class="form-control-plaintext">
                                                <!-- Menampilkan catatan pemeriksaan jika ada -->
                                                {{ $data->periksas->first()->catatan ?: 'Tidak ada catatan' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Daftar Obat yang Diresepkan -->
                            <div class="mb-4 border-2 card">
                                <div class="bg-white card-header border-bottom">
                                    <h5 class="mb-0 font-semibold text-gray-800 card-title">Daftar Obat Diresepkan</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Menampilkan daftar obat yang diresepkan -->
                                    @if ($data->periksas->first()->detailPeriksas->count() > 0)
                                        <!-- Jika ada obat yang diresepkan -->
                                        <ul class="list-group list-group-flush">
                                            <!-- List obat yang diresepkan -->
                                            @php
                                                $totalHargaObat = 0;
                                            @endphp
                                            @foreach ($data->periksas->first()->detailPeriksas as $detail)
                                                <!-- Mengulang setiap obat yang diresepkan -->
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>{{ $detail->obat->nama_obat }}</span>
                                                    <span
                                                        class="badge bg-light text-dark">{{ $detail->obat->kemasan }}</span>
                                                    <span class="badge bg-success text-white">
                                                        Rp {{ number_format($detail->obat->harga, 0, ',', '.') }}
                                                    </span>
                                                    @php
                                                        $totalHargaObat += $detail->obat->harga;
                                                    @endphp
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted">Tidak ada obat yang diresepkan.</p>
                                        <!-- Jika tidak ada obat yang diresepkan -->
                                    @endif
                                </div>
                            </div>

                            <!-- Total Harga Obat -->
                            <div class="mb-4 border-2 card bg-light">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="font-semibold text-gray-800">Total Harga Obat</span>
                                        <span class="fw-bold fs-5 text-primary">
                                            Rp {{ number_format($totalHargaObat, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Biaya Pemeriksaan -->
                            <div class="mb-4 border-2 card bg-light">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="font-semibold text-gray-800">Biaya Pemeriksaan</span>
                                        <span class="fw-bold fs-5 text-primary">
                                            Rp 150.000
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Pembayaran -->
                            <div class="mb-4 border-2 card bg-light">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="font-semibold text-gray-800">Total Pembayaran</span>
                                        <span class="fw-bold fs-5 text-danger">
                                            Rp {{ number_format(150000 + $totalHargaObat, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Kembali -->
                            <div class="mt-4">
                                <a href="{{ route('pasien.daftar-poli.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <!-- Tombol untuk kembali ke halaman daftar poli -->
                            </div>
                        @else
                            <!-- Jika tidak ada riwayat pemeriksaan -->
                            <p class="text-muted">Riwayat pemeriksaan tidak ditemukan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<!-- Menutup bagian konten utama halaman -->
