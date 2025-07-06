@extends('layouts.app')

@section('title', 'Edit Data Pasien') <!-- Mengatur judul halaman menjadi "Edit Data Pasien" -->

@section('content')
    <div class="container-fluid">
        <div class="app-content-header mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Data Pasien</h3> <!-- Judul halaman -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <!-- Breadcrumb menuju halaman home -->
                            <li class="breadcrumb-item"><a href="{{ route('admin.pasien.index') }}">Dokter</a></li>
                            <!-- Breadcrumb menuju daftar pasien -->
                            <li class="breadcrumb-item active" aria-current="page">Edit Data Pasien</li>
                            <!-- Breadcrumb untuk halaman aktif -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center align-items-center" style="min-height: 70vh;">
            <div class="col-md-11">
                <div class="card shadow-lg border-light">
                    <div class="card-header bg-success text-white rounded-top">
                        <h4 class="mb-0">Edit Data Pasien</h4> <!-- Judul form -->
                    </div>
                    <div class="card-body">
                        <!-- Form untuk mengupdate data pasien -->
                        <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
                            @csrf <!-- Menambahkan token CSRF untuk keamanan -->
                            @method('PUT') <!-- Menggunakan metode PUT untuk update data -->

                            <div class="row">
                                <!-- No RM (Read-Only) -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="no_rm" class="font-weight-bold">No RM</label>
                                        <input type="text"
                                            class="form-control @error('no_rm') is-invalid @enderror border border-primary"
                                            id="no_rm" name="no_rm" value="{{ old('no_rm', $pasien->no_rm) }}"
                                            readonly>
                                        <!-- Field ini hanya untuk menampilkan No RM yang tidak bisa diedit -->
                                        @error('no_rm')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada -->
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nama Pasien -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="nama" class="font-weight-bold">Nama Pasien</label>
                                        <input type="text"
                                            class="form-control @error('nama') is-invalid @enderror border border-primary"
                                            id="nama" name="nama" value="{{ old('nama', $pasien->nama) }}" required
                                            placeholder="Masukkan Nama Pasien">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada -->
                                        @enderror
                                    </div>
                                </div>

                                <!-- No KTP -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="no_ktp" class="font-weight-bold">No KTP</label>
                                        <input type="text"
                                            class="form-control @error('no_ktp') is-invalid @enderror border border-primary"
                                            id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $pasien->no_ktp) }}"
                                            required placeholder="Masukkan No KTP">
                                        @error('no_ktp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada -->
                                        @enderror
                                    </div>
                                </div>

                                <!-- No HP -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="no_hp" class="font-weight-bold">No HP</label>
                                        <input type="text"
                                            class="form-control @error('no_hp') is-invalid @enderror border border-primary"
                                            id="no_hp" name="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}"
                                            required placeholder="Masukkan No HP">
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada -->
                                        @enderror
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="alamat" class="font-weight-bold">Alamat</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror border border-primary" id="alamat" name="alamat"
                                            rows="4" required placeholder="Masukkan Alamat Pasien">{{ old('alamat', $pasien->alamat) }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada -->
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary px-4">
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
