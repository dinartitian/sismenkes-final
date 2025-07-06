@extends('layouts.app')
<!-- Menggunakan layout utama 'app' yang ada di file layouts.app untuk menyusun struktur dasar halaman, termasuk header, footer, dan sidebar -->

@section('content')
    <!-- Bagian konten halaman utama -->

    <div class="container">
        <!-- Kontainer utama untuk memastikan responsif dan padding di seluruh halaman -->

        <div class="app-content-header mb-4 mt-3">
            <!-- Header untuk bagian konten halaman dengan margin bawah dan atas untuk spasi -->
            <div class="container-fluid">
                <!-- Kontainer dalam untuk pengaturan responsif -->

                <div class="row">
                    <!-- Baris untuk menampilkan header dan breadcrumb -->
                    <div class="col-sm-6">
                        <h3 class="mb-0">Daftar Pasien</h3>
                        <!-- Judul halaman, menampilkan 'Daftar Dokter' -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <!-- Menampilkan breadcrumb untuk navigasi -->
                            <li class="breadcrumb-item"><a href="{{ route('pasien.dashboard') }}">Home</a></li>
                            <!-- Tautan ke halaman Home -->
                            <li class="breadcrumb-item active" aria-current="page">Detail Daftar Poli</li>
                            <!-- Menandakan halaman saat ini adalah Dashboard -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Baris untuk menampilkan dua kolom, card nomor antrian dan detail daftar poli -->

            {{-- Card Antrian --}}
            <div class="col-md-4 mb-4">
                <!-- Kolom dengan ukuran medium (col-md-4), margin bawah 4 -->
                <div class="card shadow text-center border-primary">
                    <!-- Card dengan bayangan, teks rata tengah, dan border berwarna primer -->
                    <div class="card-header bg-primary text-white">
                        <!-- Bagian header card dengan background primer dan teks putih -->
                        <h5 class="card-title mb-0">Nomor Antrian Anda</h5>
                        <!-- Judul di bagian atas card -->
                    </div>
                    <div class="card-body">
                        <!-- Bagian tubuh card untuk menampilkan nomor antrian -->
                        <h1 class="display-3 fw-bold text-primary">{{ $data->no_antrian }}</h1>
                        <!-- Menampilkan nomor antrian dalam format besar dan tebal dengan warna primer -->
                    </div>
                </div>
            </div>

            {{-- Detail Info --}}
            <div class="col-md-8 mb-4">
                <!-- Kolom kedua untuk menampilkan detail daftar poli, dengan ukuran medium (col-md-8) -->
                <div class="card shadow">
                    <!-- Card dengan bayangan -->
                    <div class="card-header bg-primary text-white">
                        <!-- Bagian header card dengan background primer dan teks putih -->
                        <h5 class="card-title mb-0">Detail Daftar Poli</h5>
                        <!-- Judul di bagian atas card -->
                    </div>
                    <ul class="list-group list-group-flush">
                        <!-- Daftar item untuk menampilkan informasi detail -->
                        <li class="list-group-item"><strong>Poli:</strong>
                            {{ $data->jadwalPeriksa->dokter->poli->nama_poli ?? '-' }}</li>
                        <!-- Menampilkan nama poli, jika data tersedia, jika tidak akan menampilkan '-' -->
                        <li class="list-group-item"><strong>Dokter:</strong> {{ $data->jadwalPeriksa->dokter->nama ?? '-' }}
                        </li>
                        <!-- Menampilkan nama dokter, jika data tersedia, jika tidak akan menampilkan '-' -->
                        <li class="list-group-item"><strong>Hari:</strong> {{ $data->jadwalPeriksa->hari }}</li>
                        <!-- Menampilkan hari jadwal pemeriksaan -->
                        <li class="list-group-item"><strong>Jam:</strong> {{ $data->jadwalPeriksa->jam_mulai }} -
                            {{ $data->jadwalPeriksa->jam_selesai }}</li>
                        <!-- Menampilkan waktu mulai dan selesai pemeriksaan -->
                        <li class="list-group-item"><strong>Keluhan:</strong> {{ $data->keluhan }}</li>
                        <!-- Menampilkan keluhan pasien -->
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
<!-- Menutup bagian konten utama halaman -->
