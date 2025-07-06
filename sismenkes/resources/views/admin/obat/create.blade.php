@extends('layouts.app')

@section('title', 'Tambah Obat Baru') <!-- Menetapkan judul halaman menjadi "Tambah Obat Baru" -->

@section('content')
    <div class="container-fluid">
        <!-- Bagian header dengan judul dan breadcrumb navigasi -->
        <div class="app-content-header mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Tambah Data Obat Baru</h3> <!-- Menampilkan judul halaman -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <!-- Navigasi ke halaman home -->
                            <li class="breadcrumb-item"><a href="{{ route('admin.obat.index') }}">Obat</a></li>
                            <!-- Navigasi ke halaman daftar obat -->
                            <li class="breadcrumb-item active" aria-current="page">Tambah Data Obat Baru</li>
                            <!-- Menampilkan breadcrumb untuk halaman aktif -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center align-items-center" style="min-height: 70vh;">
            <div class="col-md-11">
                <div class="card shadow-lg border-light">
                    <div class="card-header bg-success text-white rounded-top">
                        <h4 class="mb-0">Tambah Obat Baru</h4> <!-- Judul card -->
                    </div>
                    <div class="card-body">
                        <!-- Form untuk menambah data obat baru -->
                        <form action="{{ route('admin.obat.store') }}" method="POST">
                            <!-- Aksi form mengarah ke route untuk menyimpan obat -->
                            @csrf <!-- Menambahkan token CSRF untuk keamanan -->

                            <div class="row">
                                <!-- Nama Obat -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="nama_obat" class="font-weight-bold">Nama Obat</label>
                                        <!-- Label untuk input nama obat -->
                                        <input type="text"
                                            class="form-control @error('nama_obat') is-invalid @enderror border border-primary"
                                            id="nama_obat" name="nama_obat" value="{{ old('nama_obat') }}" required
                                            placeholder="Masukkan Nama Obat"> <!-- Input untuk nama obat -->
                                        @error('nama_obat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada kesalahan input pada kolom nama obat -->
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kemasan -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="kemasan" class="font-weight-bold">Kemasan</label>
                                        <!-- Label untuk input kemasan -->
                                        <input type="text" name="kemasan" id="kemasan"
                                            class="form-control @error('kemasan') is-invalid @enderror border border-primary"
                                            value="{{ old('kemasan') }}" required placeholder="Masukkan Kemasan Obat">
                                        <!-- Input untuk kemasan obat -->
                                        @error('kemasan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada kesalahan input pada kolom kemasan -->
                                        @enderror
                                    </div>
                                </div>

                                <!-- Harga -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="harga" class="font-weight-bold">Harga</label>
                                        <!-- Label untuk input harga obat -->
                                        <input type="number" name="harga" id="harga"
                                            class="form-control @error('harga') is-invalid @enderror border border-primary"
                                            value="{{ old('harga') }}" required placeholder="Masukkan Harga Obat">
                                        <!-- Input untuk harga obat -->
                                        @error('harga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada kesalahan input pada kolom harga -->
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Submit dan Kembali -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <!-- Tombol untuk menyimpan data obat baru -->
                                    <i class="fas fa-save"></i> Simpan Data
                                </button>
                                <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary px-4">
                                    <!-- Tombol untuk kembali ke halaman daftar obat -->
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
