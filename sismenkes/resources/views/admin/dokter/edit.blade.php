@extends('layouts.app')

@section('title', 'Edit Data Dokter') <!-- Menetapkan judul halaman menjadi "Edit Data Dokter" -->

@section('content')

    <div class="container-fluid">
        <!-- Bagian header dengan judul dan breadcrumb navigasi -->
        <div class="app-content-header mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Data Dokter</h3> <!-- Menampilkan judul halaman -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <!-- Navigasi ke Home -->
                            <li class="breadcrumb-item"><a href="{{ route('admin.dokter.index') }}">Dokter</a></li>
                            <!-- Navigasi ke halaman daftar dokter -->
                            <li class="breadcrumb-item active" aria-current="page">Edit Data Dokter</li>
                            <!-- Menampilkan breadcrumb untuk halaman aktif -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form input untuk edit data dokter -->
        <div class="row d-flex justify-content-center align-items-center" style="min-height: 70vh;">
            <div class="col-md-11">
                <div class="card shadow-lg border-light">
                    <div class="card-header bg-success text-white rounded-top">
                        <h4 class="mb-0">Edit Data Dokter</h4> <!-- Menampilkan judul card -->
                    </div>
                    <div class="card-body">
                        <!-- Form untuk mengedit data dokter -->
                        <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST">
                            <!-- Form action mengarah ke route untuk memperbarui data dokter berdasarkan ID -->
                            @csrf <!-- Menambahkan token CSRF untuk keamanan -->
                            @method('PUT') <!-- Menambahkan method PUT untuk memperbarui data -->

                            <div class="row">
                                <!-- Nama Dokter -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="nama" class="font-weight-bold">Nama Dokter</label>
                                        <!-- Label untuk input nama -->
                                        <input type="text"
                                            class="form-control @error('nama') is-invalid @enderror border border-primary"
                                            id="nama" name="nama" value="{{ old('nama', $dokter->nama) }}" required
                                            placeholder="Masukkan Nama Dokter">
                                        <!-- Input untuk nama dokter, dengan nilai default dari dokter yang diedit -->
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada kesalahan input pada kolom nama -->
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nomor HP -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="no_hp" class="font-weight-bold">Nomor HP</label>
                                        <!-- Label untuk input nomor HP -->
                                        <input type="text"
                                            class="form-control @error('no_hp') is-invalid @enderror border border-primary"
                                            id="no_hp" name="no_hp" value="{{ old('no_hp', $dokter->no_hp) }}"
                                            required placeholder="Masukkan Nomor HP">
                                        <!-- Input untuk nomor HP dokter, dengan nilai default dari dokter yang diedit -->
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada kesalahan input pada kolom nomor HP -->
                                        @enderror
                                    </div>
                                </div>

                                <!-- Poli -->
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="id_poli" class="font-weight-bold">Poli</label>
                                        <!-- Label untuk input pilihan poli -->
                                        <select
                                            class="form-control @error('id_poli') is-invalid @enderror border border-primary"
                                            id="id_poli" name="id_poli" required>
                                            <option value="">Pilih Poli</option>
                                            <!-- Opsi default untuk memilih poli -->
                                            @foreach ($polis as $poli)
                                                <option value="{{ $poli->id }}"
                                                    {{ old('id_poli', $dokter->id_poli) == $poli->id ? 'selected' : '' }}>
                                                    {{ $poli->nama_poli }}
                                                </option>
                                                <!-- Menampilkan daftar poli dari database, dengan opsi yang dipilih jika sesuai -->
                                            @endforeach
                                        </select>
                                        @error('id_poli')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada kesalahan input pada kolom poli -->
                                        @enderror
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="alamat" class="font-weight-bold">Alamat</label>
                                        <!-- Label untuk input alamat -->
                                        <textarea class="form-control @error('alamat') is-invalid @enderror border border-primary" id="alamat" name="alamat"
                                            rows="4" required placeholder="Masukkan Alamat Dokter">{{ old('alamat', $dokter->alamat) }}</textarea>
                                        <!-- Input untuk alamat dokter, dengan nilai default dari alamat dokter yang diedit -->
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada kesalahan input pada kolom alamat -->
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-success px-4"> <!-- Tombol untuk submit form -->
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary px-4">
                                    <!-- Tombol untuk kembali ke daftar dokter -->
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
