@extends('layouts.app')
<!-- Menggunakan layout utama yang ada di file layouts.app -->

@section('title', 'Jadwal Periksa Dokter')
<!-- Menetapkan judul halaman menjadi 'Jadwal Periksa Dokter', yang akan ditampilkan di tab browser -->

@section('content')
    <!-- Bagian konten halaman -->

    <main class="app-main">
        <!-- Elemen utama untuk aplikasi -->

        <div class="app-content-header">
            <!-- Header konten dengan judul dan breadcrumb -->
            <div class="container-fluid">
                <!-- Kontainer untuk memastikan responsif pada layar -->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Jadwal Periksa Dokter</h3>
                        <!-- Judul halaman -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <!-- Menampilkan breadcrumb untuk navigasi -->
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                            <!-- Tautan ke dashboard dokter -->
                            <li class="breadcrumb-item active" aria-current="page">Jadwal Periksa</li>
                            <!-- Menandakan halaman saat ini -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <!-- Kontainer untuk konten halaman utama -->

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
                <!-- Jika ada pesan 'success' dari session, menampilkan alert sukses dengan SweetAlert2 -->

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
                <!-- Jika ada pesan 'error' dari session, menampilkan alert error dengan SweetAlert2 -->

                <!-- Tombol untuk menambah jadwal baru -->
                <div class="row mb-3">
                    <div class="col-12">
                        <a href="{{ route('dokter.jadwal.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Jadwal
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Jadwal Periksa</h4>
                                <!-- Header card untuk menampilkan judul tabel -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <!-- Tabel untuk menampilkan daftar jadwal periksa -->
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Hari</th>
                                                <th>Jam Mulai</th>
                                                <th>Jam Selesai</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jadwals as $index => $jadwal)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $jadwal->hari }}</td>
                                                    <td>{{ $jadwal->jam_mulai }}</td>
                                                    <td>{{ $jadwal->jam_selesai }}</td>
                                                    <td>{{ $jadwal->status ? 'Aktif' : 'Nonaktif' }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <!-- Tombol untuk mengaktifkan/nonaktifkan jadwal -->
                                                            @if ($jadwal->status == 0)
                                                                <form
                                                                    action="{{ route('dokter.jadwal.toggleStatus', $jadwal->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="btn btn-success btn-sm"
                                                                        style="margin-right: 10px">
                                                                        <i class="bi bi-check-circle"></i> Aktifkan
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <form
                                                                    action="{{ route('dokter.jadwal.toggleStatus', $jadwal->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="btn btn-warning btn-sm"
                                                                        style="margin-right: 10px">
                                                                        <i class="bi bi-x-circle"></i> Nonaktifkan
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            <!-- Tombol untuk menghapus jadwal -->
                                                            <form
                                                                action="{{ route('dokter.jadwal.destroy', $jadwal->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm ml-2"
                                                                    onclick="return confirmDelete(event)">
                                                                    <i class="bi bi-trash"></i> Hapus
                                                                </button>
                                                            </form>
                                                        </div>
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

    <!-- Form Hapus -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Menampilkan DataTable untuk tabel jadwal
        $(document).ready(function() {
            $('table').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });
        });

        // Konfirmasi Hapus menggunakan SweetAlert2
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form submit langsung
            const form = event.target.closest('form'); // Mendapatkan form terkait tombol hapus
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Jadwal ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Jika ya, submit form untuk menghapus
                }
            });
        }
    </script>
@endpush
