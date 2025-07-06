@extends('layouts.app')

@section('title')
    ADMIN
@endsection

@section('content')
    <main class="app-main">
        <!-- Bagian header dengan judul dan breadcrumb navigasi -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Daftar Dokter</h3> <!-- Menampilkan judul halaman "Daftar Dokter" -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <!-- Navigasi ke Home -->
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            <!-- Menampilkan breadcrumb untuk halaman aktif -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <!-- Menampilkan Toast Alert jika ada pesan success -->
                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: '{{ session('success') }}',
                            showConfirmButton: false,
                            timer: 1500 // Toast alert ditampilkan selama 1500ms
                        });
                    </script>
                @endif

                <!-- Menampilkan Toast Alert jika ada pesan error -->
                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: '{{ session('error') }}',
                            showConfirmButton: false,
                            timer: 1500 // Toast alert ditampilkan selama 1500ms
                        });
                    </script>
                @endif

                <!-- Tombol untuk menambahkan dokter baru -->
                <div class="row mb-3">
                    <div class="col-12">
                        <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Dokter
                        </a>
                    </div>
                </div>

                <!-- Tabel untuk menampilkan daftar dokter -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Dokter</h4> <!-- Menampilkan judul tabel -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dokterTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Dokter</th>
                                                <th>Alamat</th>
                                                <th>No. HP</th>
                                                <th>Poli</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dokters as $index => $dokter)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut dokter -->
                                                    <td>{{ $dokter->nama }}</td> <!-- Menampilkan nama dokter -->
                                                    <td>{{ $dokter->alamat }}</td> <!-- Menampilkan alamat dokter -->
                                                    <td>{{ $dokter->no_hp }}</td> <!-- Menampilkan nomor HP dokter -->
                                                    <td>
                                                        @if ($dokter->poli)
                                                            {{ $dokter->poli->nama_poli }}
                                                        @else
                                                            <span class="text-muted">Tidak ada Poli</span>
                                                        @endif
                                                        <!-- Menampilkan nama poli dokter, jika ada -->
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.dokter.edit', $dokter->id) }}"
                                                                class="btn btn-warning btn-sm mx-1">
                                                                <i class="bi bi-pencil"></i> Edit
                                                            </a>

                                                            <!-- Tombol untuk menghapus dokter -->
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm mx-1 delete-btn"
                                                                data-id="{{ $dokter->id }}">
                                                                <i class="bi bi-trash"></i> Hapus
                                                            </button>
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

    <!-- Form untuk menghapus dokter (tersembunyi) -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <!-- Menambahkan script untuk SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Menginisialisasi DataTables untuk tabel dokter
            $('#dokterTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' // Menggunakan bahasa Indonesia untuk DataTables
                }
            });

            // Tombol Hapus Dokter
            $('.delete-btn').click(function() {
                var dokterId = $(this).data('id'); // Mengambil ID dokter yang akan dihapus
                var deleteUrl = "{{ route('admin.dokter.destroy', ':id') }}".replace(':id',
                    dokterId); // Membuat URL untuk menghapus dokter

                // Menampilkan SweetAlert konfirmasi untuk menghapus
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data dokter akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna mengonfirmasi, kirim form delete
                        $('#deleteForm').attr('action', deleteUrl).submit();
                    }
                });
            });
        });
    </script>
@endpush
