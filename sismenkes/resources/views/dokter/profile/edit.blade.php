@extends('layouts.app')
<!-- Menggunakan layout utama 'app' yang ada di file layouts.app untuk menyusun struktur halaman ini -->

@section('title', 'Edit Profile Dokter')
<!-- Menetapkan judul halaman di browser menjadi 'Edit Profile Dokter' -->

@section('content_header')
    <h1>Edit Profile Dokter</h1>
@stop
<!-- Menambahkan header konten dengan judul 'Edit Profile Dokter' -->

@section('content')
    <!-- Bagian konten utama halaman -->

    <div class="container-fluid">
        <!-- Kontainer utama dengan lebar penuh -->

        <div class="app-content-header mt-3">
            <!-- Header bagian konten untuk menampilkan judul dan breadcrumb -->
            <div class="container-fluid">
                <!-- Kontainer dalam untuk pengaturan responsif -->
                <div class="row">
                    <!-- Baris untuk menampilkan kolom header -->
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Profile Dokter</h3>
                        <!-- Judul halaman -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <!-- Menampilkan breadcrumb untuk navigasi -->
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                            <!-- Tautan ke dashboard dokter -->
                            <li class="breadcrumb-item active" aria-current="page">Edit Profile Dokter</li>
                            <!-- Menandakan halaman saat ini -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center align-items-center" style="min-height: 70vh;">
            <!-- Baris untuk menampilkan form di tengah halaman dengan tinggi minimal 70vh -->
            <div class="col-md-11">
                <div class="card shadow-lg border-light">
                    <!-- Card untuk membungkus form -->
                    <div class="card-header bg-success text-white rounded-top">
                        <!-- Header card dengan background hijau dan teks putih -->
                        <h4 class="mb-0">Edit Profile Dokter</h4>
                        <!-- Judul form -->
                    </div>
                    <div class="card-body">
                        <!-- Bagian tubuh card untuk menampilkan form -->
                        <form action="{{ route('dokter.profile.update') }}" method="POST">
                            <!-- Form untuk memperbarui profil dokter dengan metode POST -->
                            @csrf
                            <!-- Token CSRF untuk keamanan -->
                            @method('PATCH')
                            <!-- Menentukan method PATCH untuk pembaruan data -->

                            <input type="hidden" name="id_daftar_poli" value="{{ $dokter->id }}">
                            <!-- Menyembunyikan ID poli untuk keperluan penyimpanan -->

                            <div class="row">
                                <!-- Row untuk mengelompokkan input form dalam kolom -->

                                <!-- Input Nama Dokter -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="nama" class="font-weight-bold">Nama Dokter</label>
                                        <!-- Label untuk input nama dokter -->
                                        <input type="text"
                                            class="form-control border border-primary @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama', $dokter->nama) }}" required
                                            placeholder="Masukkan Nama Dokter">
                                        <!-- Input teks untuk nama dokter, dengan validasi error -->
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <!-- Menampilkan pesan error jika ada masalah dengan input nama -->
                                    </div>
                                </div>

                                <!-- Input Nomor HP -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="no_hp" class="font-weight-bold">Nomor HP</label>
                                        <!-- Label untuk input nomor HP -->
                                        <input type="text"
                                            class="form-control border border-primary @error('no_hp') is-invalid @enderror"
                                            id="no_hp" name="no_hp" value="{{ old('no_hp', $dokter->no_hp) }}"
                                            required placeholder="Masukkan Nomor HP">
                                        <!-- Input teks untuk nomor HP dokter, dengan validasi error -->
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <!-- Menampilkan pesan error jika ada masalah dengan input nomor HP -->
                                    </div>
                                </div>

                                <!-- Input Poli -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="id_poli" class="font-weight-bold">Poli</label>
                                        <!-- Label untuk input poli -->
                                        <select
                                            class="form-control border border-primary @error('id_poli') is-invalid @enderror"
                                            id="id_poli" name="id_poli" required>
                                            <!-- Dropdown untuk memilih poli -->
                                            <option value="">Pilih Poli</option>
                                            @foreach ($polis as $poli)
                                                <option value="{{ $poli->id }}"
                                                    {{ old('id_poli', $dokter->id_poli) == $poli->id ? 'selected' : '' }}>
                                                    {{ $poli->nama_poli }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_poli')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <!-- Menampilkan pesan error jika ada masalah dengan input poli -->
                                    </div>
                                </div>

                                <!-- Input Alamat -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="alamat" class="font-weight-bold">Alamat</label>
                                        <!-- Label untuk input alamat -->
                                        <textarea class="form-control border border-primary @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                            rows="4" required placeholder="Masukkan Alamat Dokter">{{ old('alamat', $dokter->alamat) }}</textarea>
                                        <!-- Textarea untuk alamat dokter, dengan validasi error -->
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <!-- Menampilkan pesan error jika ada masalah dengan input alamat -->
                                    </div>
                                </div>
                            </div>

                            <!-- Button untuk menyimpan perubahan -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <!-- Tombol untuk menyimpan perubahan profile dokter -->
                                <a href="{{ route('dokter.dashboard') }}" class="btn btn-secondary px-4">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <!-- Tombol untuk kembali ke dashboard dokter -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
<!-- Menutup bagian konten halaman utama -->

@push('scripts')
    <!-- Menyertakan SweetAlert2 untuk menampilkan notifikasi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <!-- Menampilkan SweetAlert2 jika ada pesan sukses dari session -->
@endpush
