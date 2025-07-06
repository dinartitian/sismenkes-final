@extends('layouts.app')

@section('title', 'Edit Poli') <!-- Menetapkan title halaman pada browser menjadi 'Edit Poli' -->

@section('content')
    <div class="container-fluid">
        <div class="app-content-header mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Data Poli</h3>
                        <!-- Judul halaman yang menunjukkan bahwa ini adalah halaman untuk mengedit data Poli -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <!-- Menambahkan breadcrumb untuk menu Home -->
                            <li class="breadcrumb-item"><a href="{{ route('admin.poli.index') }}">Poli</a></li>
                            <!-- Breadcrumb untuk mengarahkan ke halaman daftar Poli -->
                            <li class="breadcrumb-item active" aria-current="page">Edit Data Poli</li>
                            <!-- Breadcrumb untuk halaman aktif 'Edit Data Poli' -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center align-items-center" style="min-height: 70vh;">
            <div class="col-md-11">
                <div class="card shadow-lg border-light">
                    <div class="card-header bg-success text-white rounded-top">
                        <h4 class="mb-0">Edit Poli</h4>
                        <!-- Judul bagian form -->
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.poli.update', $poli->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Menambahkan CSRF token untuk form keamanan dan method PUT untuk update -->

                            <div class="row">
                                <!-- Form input untuk Nama Poli -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="nama_poli" class="font-weight-bold">Nama Poli</label>
                                        <input type="text"
                                            class="form-control @error('nama_poli') is-invalid @enderror border border-primary"
                                            id="nama_poli" name="nama_poli" value="{{ old('nama_poli', $poli->nama_poli) }}"
                                            required placeholder="Masukkan Nama Poli">
                                        <!-- Field untuk input Nama Poli dengan validasi error jika ada -->
                                        @error('nama_poli')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada kesalahan input -->
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form input untuk Keterangan -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror border border-primary" id="keterangan"
                                            name="keterangan" rows="4" required placeholder="Masukkan Keterangan Poli">{{ old('keterangan', $poli->keterangan) }}</textarea>
                                        <!-- Field untuk input Keterangan Poli dengan validasi error jika ada -->
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada kesalahan input -->
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol untuk simpan perubahan atau kembali -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                    <!-- Tombol untuk menyimpan perubahan data -->
                                </button>
                                <a href="{{ route('admin.poli.index') }}" class="btn btn-secondary px-4">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                    <!-- Tombol untuk kembali ke halaman daftar Poli -->
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
