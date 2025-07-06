@extends('layouts.app')
<!-- Menggunakan layout utama 'app' yang ada di file layouts.app, sehingga halaman ini mengikuti struktur dasar aplikasi yang sudah ditentukan, termasuk header, footer, dan sidebar -->

@section('content')
    <!-- Bagian utama konten halaman -->

    <div class="container-fluid py-3">
        <!-- Kontainer utama untuk memastikan responsif dan padding di seluruh halaman -->

        <div class="app-content-header mb-4 mt-3">
            <!-- Header untuk bagian konten halaman dengan margin bawah dan atas untuk spasi -->
            <div class="container-fluid">
                <!-- Kontainer dalam untuk pengaturan responsif -->
                <div class="row">
                    <!-- Baris untuk menampilkan header dan breadcrumb -->
                    <div class="col-sm-6">
                        <h3 class="mb-0">Daftar Poli</h3>
                        <!-- Judul halaman, menampilkan 'Daftar Dokter' -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <!-- Menampilkan breadcrumb untuk navigasi -->
                            <li class="breadcrumb-item"><a href="{{ route('pasien.dashboard') }}">Home</a></li>
                            <!-- Tautan untuk navigasi ke halaman Home -->
                            <li class="breadcrumb-item active" aria-current="page">Daftar Poli</li>
                            <!-- Menandakan halaman saat ini adalah Dashboard -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <!-- Menampilkan pesan sukses jika ada session('success') -->
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <!-- Jika ada session success, maka menampilkan alert dengan pesan sukses -->

        <div class="row">
            <!-- Baris untuk menampilkan dua kolom: Form Daftar Poli dan Tabel Riwayat -->

            {{-- Card Form Daftar Poli --}}
            <div class="col-md-4">
                <!-- Kolom dengan ukuran medium (col-md-4) -->
                <div class="card shadow-sm">
                    <!-- Card dengan bayangan ringan -->
                    <div class="card-header" style="background-color: #007BFF; color: #ffffff;">
                        <!-- Header card dengan warna latar belakang biru dan teks putih -->
                        <h5 class="card-title mb-0">Form Daftar Poli</h5>
                        <!-- Judul card -->
                    </div>

                    <div class="card-body">
                        <!-- Bagian tubuh card untuk menampilkan form -->
                        <form method="POST" action="{{ route('pasien.daftar-poli.store') }}">
                            <!-- Form untuk mendaftar poli baru, dengan method POST ke route yang telah ditentukan -->
                            @csrf
                            <!-- Token CSRF untuk keamanan -->

                            <div class="mb-3">
                                <label>No RM</label>
                                <input type="text" class="form-control" value="{{ $pasien->no_rm }}" readonly>
                                <!-- Menampilkan nomor RM pasien yang tidak dapat diubah -->
                            </div>

                            <div class="mb-3">
                                <label>Pilih Poli</label>
                                <select id="poli" class="form-select" required>
                                    <option value="">-- Pilih Poli --</option>
                                    @foreach ($poliList as $poli)
                                        <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                    @endforeach
                                </select>
                                <!-- Dropdown untuk memilih poli, menampilkan semua daftar poli -->
                            </div>

                            <div class="mb-3">
                                <label>Pilih Jadwal</label>
                                <select name="id_jadwal" id="jadwal" class="form-select" required></select>
                                <!-- Dropdown untuk memilih jadwal berdasarkan poli yang dipilih, diisi dengan AJAX -->
                            </div>

                            <div class="mb-3">
                                <label>Keluhan</label>
                                <textarea name="keluhan" class="form-control" rows="3" required></textarea>
                                <!-- Textarea untuk memasukkan keluhan pasien -->
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Daftar</button>
                            <!-- Tombol untuk mengirimkan form -->
                        </form>
                    </div>
                </div>
            </div>

            {{-- Card Tabel Riwayat --}}
            <div class="col-md-8">
                <!-- Kolom dengan ukuran medium (col-md-8) -->
                <div class="card shadow-sm">
                    <!-- Card dengan bayangan ringan -->
                    <div class="card-header" style="background-color: #007BFF; color: #ffffff;">
                        <!-- Header card dengan warna latar belakang biru dan teks putih -->
                        <h5 class="card-title mb-0">Riwayat Daftar Poli</h5>
                        <!-- Judul card -->
                    </div>
                    <div class="card-body table-responsive">
                        <!-- Bagian tubuh card untuk menampilkan tabel riwayat daftar poli -->
                        <table class="table table-bordered table-striped" id="riwayat-table">
                            <!-- Tabel untuk menampilkan riwayat daftar poli -->
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Antrian</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayat as $i => $item)
                                    <!-- Mengulang data riwayat pendaftaran poli -->
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <!-- Menampilkan nomor urut riwayat -->
                                        <td>{{ $item->jadwalPeriksa->dokter->poli->nama_poli ?? '-' }}</td>
                                        <!-- Menampilkan nama poli terkait jadwal pemeriksaan -->
                                        <td>{{ $item->jadwalPeriksa->dokter->nama ?? '-' }}</td>
                                        <!-- Menampilkan nama dokter terkait jadwal pemeriksaan -->
                                        <td>{{ $item->jadwalPeriksa->hari }}</td>
                                        <!-- Menampilkan hari jadwal pemeriksaan -->
                                        <td>{{ $item->jadwalPeriksa->jam_mulai }} -
                                            {{ $item->jadwalPeriksa->jam_selesai }}</td>
                                        <!-- Menampilkan jam mulai dan jam selesai pemeriksaan -->
                                        <td>{{ $item->no_antrian }}</td>
                                        <!-- Menampilkan nomor antrian -->
                                        <td>
                                            @if ($item->periksas->count())
                                                <span class="badge bg-success">Sudah Diperiksa</span>
                                            @else
                                                <span class="badge bg-danger">Belum Diperiksa</span>
                                            @endif
                                            <!-- Menampilkan status apakah pasien sudah diperiksa atau belum -->
                                        </td>
                                        <td>
                                            @if ($item->periksas->count() > 0)
                                                <!-- Jika sudah diperiksa, tampilkan tombol Riwayat -->
                                                <a href="{{ route('pasien.riwayat-pemeriksaan', $item->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-file-earmark-medical"></i> Riwayat
                                                </a>
                                            @else
                                                <!-- Jika belum diperiksa, tampilkan tombol Detail -->
                                                <a href="{{ route('pasien.daftar-poli.detail', $item->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="bi bi-eye"></i> Detail
                                                </a>
                                            @endif
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

    <!-- Script -->
    @push('scripts')
        <!-- Menambahkan skrip tambahan ke dalam halaman -->
        <script>
            document.getElementById('poli').addEventListener('change', function() {
                const poliId = this.value;
                const jadwalSelect = document.getElementById('jadwal');
                jadwalSelect.innerHTML = '<option value="">Memuat...</option>';

                fetch("{{ url('pasien/jadwal-by-poli') }}/" + poliId)
                    .then(response => response.json())
                    .then(data => {
                        jadwalSelect.innerHTML = '';
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.text =
                                `${item.hari} | ${item.jam_mulai} - ${item.jam_selesai} (Dr. ${item.dokter.nama})`;
                            jadwalSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Gagal memuat jadwal:', error);
                        jadwalSelect.innerHTML = '<option value="">Gagal memuat jadwal</option>';
                    });
            });

            // DataTables
            document.addEventListener("DOMContentLoaded", function() {
                $('#riwayat-table').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                    }
                });
            });
        </script>
    @endpush
    <!-- Script untuk memuat jadwal berdasarkan poli yang dipilih dan DataTables -->
@endsection
