@extends('layouts.app')

@section('title', 'Daftar Poli')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Daftar Poli</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar Poli</li>
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
                        <a href="{{ route('admin.poli.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Poli
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Poli</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="poliTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Poli</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($polis as $index => $poli)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $poli->nama_poli }}</td>
                                                    <td>{{ $poli->keterangan }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.poli.edit', $poli->id) }}"
                                                                class="btn btn-warning btn-sm mx-1">
                                                                <i class="bi bi-pencil"></i> Edit
                                                            </a>

                                                            <button type="button"
                                                                class="btn btn-danger btn-sm mx-1 delete-btn"
                                                                data-id="{{ $poli->id }}">
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

    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#poliTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });

            $('.delete-btn').click(function() {
                var poliId = $(this).data('id');
                var deleteUrl = "{{ route('admin.poli.destroy', ':id') }}".replace(':id', poliId);

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data poli akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteForm').attr('action', deleteUrl).submit();
                    }
                });
            });
        });
    </script>
@endpush
