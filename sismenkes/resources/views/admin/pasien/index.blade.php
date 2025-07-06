@extends('layouts.app')

@section('title')
    Daftar Pasien
@endsection

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Daftar Pasien</h3> <!-- Judul utama halaman -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <!-- Breadcrumb untuk navigasi ke halaman Home -->
                            <li class="breadcrumb-item active" aria-current="page">Daftar Pasien</li>
                            <!-- Breadcrumb untuk halaman aktif Daftar Pasien -->
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
                        <a href="{{ route('admin.pasien.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Pasien <!-- Tombol untuk menambah pasien baru -->
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Pasien</h4> <!-- Judul tabel -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="pasienTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No RM</th>
                                                <th>Nama Pasien</th>
                                                <th>Alamat</th>
                                                <th>No. HP</th>
                                                <th>Aksi</th> <!-- Kolom untuk aksi seperti Edit dan Hapus -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pasien as $index => $p)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td> <!-- Nomor urut pasien -->
                                                    <td>{{ $p->no_rm }}</td> <!-- Nomor Rekam Medis pasien -->
                                                    <td>{{ $p->nama }}</td> <!-- Nama pasien -->
                                                    <td>{{ $p->alamat }}</td> <!-- Alamat pasien -->
                                                    <td>{{ $p->no_hp }}</td> <!-- Nomor HP pasien -->
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.pasien.edit', $p->id) }}"
                                                                class="btn btn-warning btn-sm mx-1">
                                                                <i class="bi bi-pencil"></i> Edit
                                                                <!-- Tombol untuk mengedit data pasien -->
                                                            </a>

                                                            <button type="button"
                                                                class="btn btn-danger btn-sm mx-1 delete-btn"
                                                                data-id="{{ $p->id }}">
                                                                <i class="bi bi-trash"></i> Hapus
                                                                <!-- Tombol untuk menghapus data pasien -->
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

    <!-- Form untuk penghapusan data pasien yang disembunyikan -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Memuat SweetAlert2 untuk tampilan alert -->

    <script>
        $(document).ready(function() {
            $('#pasienTable')
                .DataTable({ // Menggunakan DataTables untuk membuat tabel interaktif dengan pencarian dan pengurutan
                    responsive: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' // Mengatur bahasa untuk DataTable ke bahasa Indonesia
                    }
                });

            // Fungsi untuk menangani penghapusan data pasien
            $('.delete-btn').click(function() {
                var pasienId = $(this).data('id'); // Mengambil ID pasien yang dipilih
                var deleteUrl = "{{ route('admin.pasien.destroy', ':id') }}".replace(':id',
                    pasienId); // Menyiapkan URL penghapusan

                Swal.fire({
                    title: 'Apakah Anda yakin?', // Menampilkan konfirmasi penghapusan
                    text: "Data pasien akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) { // Jika pengguna mengkonfirmasi penghapusan
                        $('#deleteForm').attr('action', deleteUrl)
                            .submit(); // Men-submit form untuk menghapus data pasien
                    }
                });
            });
        });
    </script>
@endpush
