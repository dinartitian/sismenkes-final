@extends('layouts.app')
<!-- Menggunakan layout utama yang ada di file layouts.app -->

@section('title', 'Tambah Jadwal Periksa Dokter')
<!-- Menetapkan judul halaman menjadi 'Tambah Jadwal Periksa Dokter', yang akan ditampilkan di tab browser -->

@section('content')
    <!-- Bagian konten halaman -->

    <div class="container-fluid">
        <!-- Kontainer utama untuk mengatur layout halaman dengan lebar penuh -->

        <div class="app-content-header mt-3">
            <!-- Header konten dengan jarak atas (margin) yang sedikit -->
            <div class="container-fluid">
                <!-- Kontainer dalam untuk pengaturan responsif -->

                <div class="row">
                    <!-- Baris untuk mengatur tampilan dua kolom (untuk header dan breadcrumb) -->
                    <div class="col-sm-6">
                        <h3 class="mb-0">Tambah Jadwal Periksa Dokter</h3>
                        <!-- Judul halaman untuk 'Tambah Jadwal Periksa Dokter' -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <!-- Menampilkan breadcrumb yang memberikan navigasi -->
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                            <!-- Tautan ke dashboard dokter -->
                            <li class="breadcrumb-item"><a href="{{ route('dokter.jadwal.index') }}">Jadwal Periksa</a></li>
                            <!-- Tautan ke halaman daftar jadwal periksa dokter -->
                            <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal Periksa</li>
                            <!-- Menandai halaman saat ini (Tambah Jadwal Periksa) -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian utama form untuk menambah jadwal -->
        <div class="row d-flex justify-content-center align-items-center" style="min-height: 70vh;">
            <!-- Membuat baris yang menempatkan form di tengah halaman dengan tinggi minimal 70% viewport -->
            <div class="col-md-11">
                <div class="card shadow-lg border-light">
                    <!-- Card container untuk menampung form input -->
                    <div class="card-header bg-success text-white rounded-top">
                        <!-- Header card dengan background hijau dan teks putih -->
                        <h4 class="mb-0">Tambah Jadwal Periksa</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dokter.jadwal.store') }}" method="POST">
                            <!-- Formulir untuk menyimpan data jadwal periksa baru dengan metode POST ke route 'dokter.jadwal.store' -->
                            @csrf
                            <!-- Menyertakan token CSRF untuk melindungi form dari serangan CSRF -->

                            <div class="row">
                                <!-- Row untuk mengelompokkan input form dalam kolom -->

                                <!-- Input Hari -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="hari" class="font-weight-bold">Hari</label>
                                        <!-- Label untuk input Hari -->
                                        <select name="hari" id="hari"
                                            class="form-control @error('hari') is-invalid @enderror border border-primary"
                                            required>
                                            <!-- Dropdown untuk memilih hari, dengan validasi error -->
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                            <option value="Minggu">Minggu</option>
                                        </select>
                                        @error('hari')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <!-- Menampilkan pesan error jika ada masalah dengan input hari -->
                                    </div>
                                </div>

                                <!-- Input Jam Mulai -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="jam_mulai" class="font-weight-bold">Jam Mulai</label>
                                        <!-- Label untuk input Jam Mulai -->
                                        <input type="time" name="jam_mulai" id="jam_mulai"
                                            class="form-control @error('jam_mulai') is-invalid @enderror border border-primary"
                                            required>
                                        <!-- Input untuk jam mulai dengan tipe 'time' -->
                                        @error('jam_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <!-- Menampilkan pesan error jika ada masalah dengan input jam mulai -->
                                    </div>
                                </div>

                                <!-- Input Jam Selesai -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="jam_selesai" class="font-weight-bold">Jam Selesai</label>
                                        <!-- Label untuk input Jam Selesai -->
                                        <input type="time" name="jam_selesai" id="jam_selesai"
                                            class="form-control @error('jam_selesai') is-invalid @enderror border border-primary"
                                            required>
                                        <!-- Input untuk jam selesai dengan tipe 'time' -->
                                        @error('jam_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <!-- Menampilkan pesan error jika ada masalah dengan input jam selesai -->
                                    </div>
                                </div>
                            </div>

                            <!-- Button untuk submit dan kembali -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save"></i> Simpan Jadwal
                                </button>
                                <!-- Tombol untuk mengirimkan formulir dengan teks "Simpan Jadwal" dan ikon save -->
                                <a href="{{ route('dokter.jadwal.index') }}" class="btn btn-secondary px-4">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <!-- Tombol untuk kembali ke halaman daftar jadwal dengan teks "Kembali" dan ikon panah kiri -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
