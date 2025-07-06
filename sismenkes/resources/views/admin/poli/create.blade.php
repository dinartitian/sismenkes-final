@extends('layouts.app')

@section('title', 'Tambah Poli') <!-- Menentukan judul halaman yang ditampilkan pada tab browser -->

@section('content')
    <div class="container-fluid">
        <div class="app-content-header mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Tambah Data Poli</h3> <!-- Judul halaman untuk tambah data poli -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <!-- Menampilkan breadcrumb navigasi untuk halaman utama -->
                            <li class="breadcrumb-item"><a href="{{ route('admin.poli.index') }}">Poli</a></li>
                            <!-- Menampilkan breadcrumb untuk halaman daftar poli -->
                            <li class="breadcrumb-item active" aria-current="page">Tambah Data Poli</li>
                            <!-- Menampilkan breadcrumb untuk halaman aktif 'Tambah Data Poli' -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center align-items-center" style="min-height: 70vh;">
            <div class="col-md-11">
                <div class="card shadow-lg border-light">
                    <div class="card-header bg-success text-white rounded-top">
                        <h4 class="mb-0">Tambah Poli</h4> <!-- Judul form untuk menambah data poli -->
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.poli.store') }}" method="POST">
                            @csrf
                            <!-- Menambahkan token CSRF untuk keamanan form -->

                            <div class="row">
                                <!-- Form input untuk Nama Poli -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="nama_poli" class="font-weight-bold">Nama Poli</label>
                                        <!-- Label untuk input Nama Poli -->
                                        <input type="text"
                                            class="form-control @error('nama_poli') is-invalid @enderror border border-primary"
                                            id="nama_poli" name="nama_poli" value="{{ old('nama_poli') }}" required
                                            placeholder="Masukkan Nama Poli">
                                        <!-- Input untuk Nama Poli yang disertai validasi error jika ada -->
                                        @error('nama_poli')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada kesalahan -->
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form input untuk Keterangan Poli -->
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                        <!-- Label untuk input Keterangan Poli -->
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror border border-primary" id="keterangan"
                                            name="keterangan" rows="4" required placeholder="Masukkan Keterangan Poli">{{ old('keterangan') }}</textarea>
                                        <!-- Input untuk Keterangan Poli dengan validasi error -->
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            <!-- Menampilkan pesan error jika ada kesalahan -->
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Button untuk menyimpan data atau kembali -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save"></i> Simpan Data
                                </button>
                                <a href="{{ route('admin.poli.index') }}" class="btn btn-secondary px-4">
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
