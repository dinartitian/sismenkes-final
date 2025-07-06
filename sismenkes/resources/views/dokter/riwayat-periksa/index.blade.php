@extends('layouts.app')
<!-- Menggunakan layout utama 'app' dari file layouts.app untuk menyusun struktur halaman ini -->

@section('title', 'Riwayat Pemeriksaan Pasien')
<!-- Menetapkan judul halaman di browser menjadi 'Riwayat Pemeriksaan Pasien' -->

@section('content')
    <!-- Bagian konten halaman utama -->

    <main class="app-main">
        <!-- Bagian utama aplikasi yang membungkus seluruh konten utama halaman -->

        <div class="app-content-header">
            <!-- Header bagian konten untuk menampilkan judul dan breadcrumb -->
            <div class="container-fluid">
                <!-- Kontainer untuk memastikan responsif pada layar -->
                <div class="row">
                    <!-- Baris untuk menampilkan kolom header -->
                    <div class="col-sm-6">
                        <h3 class="mb-0">Riwayat Pemeriksaan Pasien</h3>
                        <!-- Judul halaman -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <!-- Menampilkan breadcrumb untuk navigasi -->
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                            <!-- Tautan ke dashboard dokter -->
                            <li class="breadcrumb-item active" aria-current="page">Riwayat Pemeriksaan Pasien</li>
                            <!-- Menandakan halaman saat ini -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <!-- Kontainer utama untuk konten halaman -->

                <!-- Menampilkan Toast Alert jika ada pesan success -->
                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: '{{ session('success') }}',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                @endif
                <!-- Jika ada pesan sukses yang disimpan dalam session, tampilkan SweetAlert2 toast sukses -->

                <!-- Menampilkan Toast Alert jika ada pesan error -->
                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: '{{ session('error') }}',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                @endif
                <!-- Jika ada pesan error dalam session, tampilkan SweetAlert2 toast error -->

                <div class="row">
                    <!-- Baris untuk menampilkan tabel riwayat pemeriksaan pasien -->
                    <div class="col-lg-12">
                        <!-- Kolom untuk menampung card untuk tabel -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Riwayat Pemeriksaan Pasien</h4>
                                <!-- Header card untuk menampilkan judul tabel -->
                            </div>
                            <div class="card-body">
                                <!-- Bagian tubuh card untuk menampilkan tabel -->
                                <div class="table-responsive">
                                    <!-- Membungkus tabel dalam elemen responsif -->
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <!-- Tabel untuk menampilkan daftar pasien dengan riwayat pemeriksaan -->
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pasien</th>
                                                <th>Alamat</th>
                                                <th>No KTP</th>
                                                <th>No HP</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pasien as $key => $p)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <!-- Menampilkan nomor urut pasien -->
                                                    <td>{{ $p->nama }}</td>
                                                    <!-- Menampilkan nama pasien -->
                                                    <td>{{ $p->alamat }}</td>
                                                    <!-- Menampilkan alamat pasien -->
                                                    <td>{{ $p->no_ktp }}</td>
                                                    <!-- Menampilkan nomor KTP pasien -->
                                                    <td>{{ $p->no_hp }}</td>
                                                    <!-- Menampilkan nomor HP pasien -->
                                                    <td>
                                                        <a href="{{ route('dokter.riwayat-periksa.show', $p->id) }}"
                                                            class="btn btn-info btn-sm">
                                                            Lihat Riwayat
                                                        </a>
                                                        <!-- Menampilkan tombol untuk melihat riwayat pemeriksaan pasien -->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
<!-- Menutup bagian konten utama halaman -->

@push('scripts')
    <!-- Menyertakan SweetAlert2 untuk menampilkan notifikasi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Menampilkan DataTable untuk tabel riwayat pemeriksaan pasien
        $(document).ready(function() {
            $('table').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                    // Menambahkan dukungan bahasa Indonesia untuk DataTable
                }
            });
        });
    </script>
@endpush
