@extends('layouts.app')

@section('title', 'Daftar Obat') <!-- Menetapkan judul halaman menjadi "Daftar Obat" -->

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Daftar Obat</h3> <!-- Menampilkan judul halaman -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <!-- Breadcrumb menuju home -->
                            <li class="breadcrumb-item active" aria-current="page">Daftar Obat</li>
                            <!-- Breadcrumb untuk halaman aktif -->
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
                            timer: 1500
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
                            timer: 1500
                        });
                    </script>
                @endif

                <div class="row mb-3">
                    <div class="col-12">
                        <a href="{{ route('admin.obat.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Obat Baru
                        </a> <!-- Tombol untuk menambah obat baru -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Obat</h4> <!-- Judul tabel -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="obatTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Kemasan</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($obats as $index => $obat)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                                                    <td>{{ $obat->nama_obat }}</td> <!-- Menampilkan nama obat -->
                                                    <td>{{ $obat->kemasan }}</td> <!-- Menampilkan kemasan obat -->
                                                    <td>{{ number_format($obat->harga, 2) }}</td>
                                                    <!-- Menampilkan harga obat, format dengan 2 decimal -->
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <!-- Tombol Edit untuk mengubah data obat -->
                                                            <a href="{{ route('admin.obat.edit', $obat->id) }}"
                                                                class="btn btn-warning btn-sm mx-1">
                                                                <i class="bi bi-pencil"></i> Edit
                                                            </a>

                                                            <!-- Tombol Hapus untuk menghapus obat -->
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm mx-1 delete-btn"
                                                                data-id="{{ $obat->id }}">
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

    <!-- Form tersembunyi untuk mengirim request delete -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Mengimpor SweetAlert2 untuk tampilan alert -->

    <script>
        $(document).ready(function() {
            // Menginisialisasi DataTables untuk tabel dengan id "obatTable"
            $('#obatTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' // Bahasa Indonesia untuk DataTables
                }
            });

            // Menangani tombol delete saat diklik
            $('.delete-btn').click(function() {
                var obatId = $(this).data('id'); // Mendapatkan ID obat yang ingin dihapus
                var deleteUrl = "{{ route('admin.obat.destroy', ':id') }}".replace(':id',
                obatId); // Membuat URL delete berdasarkan ID

                // Menampilkan konfirmasi dengan SweetAlert2
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data obat akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteForm').attr('action', deleteUrl)
                    .submit(); // Jika dikonfirmasi, kirim form delete
                    }
                });
            });
        });
    </script>
@endpush
