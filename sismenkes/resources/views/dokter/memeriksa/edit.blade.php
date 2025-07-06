@extends('layouts.app')
<!-- Menggunakan layout utama 'app' dari file layouts.app untuk struktur halaman ini -->

@section('title', 'Edit Pemeriksaan Pasien')
<!-- Menetapkan judul halaman di browser menjadi 'Edit Pemeriksaan Pasien' -->

@section('content')
    <!-- Bagian konten halaman -->

    <main class="app-main">
        <!-- Bagian utama aplikasi yang membungkus konten utama halaman -->
        <div class="app-content-header">
            <!-- Header bagian konten, berfungsi untuk menampilkan judul dan breadcrumb -->
            <div class="container-fluid">
                <!-- Kontainer untuk memastikan responsif pada layar -->
                <div class="row">
                    <!-- Baris untuk mengatur elemen-elemen kolom di dalam header -->
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Pemeriksaan Pasien</h3>
                        <!-- Judul halaman 'Edit Pemeriksaan Pasien' -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <!-- Menampilkan breadcrumb untuk navigasi -->
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                            <!-- Tautan ke dashboard dokter -->
                            <li class="breadcrumb-item"><a href="{{ route('dokter.memeriksa.index') }}">Jadwal Memeriksa</a>
                            </li>
                            <!-- Tautan ke halaman daftar jadwal memeriksa -->
                            <li class="breadcrumb-item active" aria-current="page">Edit Pemeriksaan Pasien</li>
                            <!-- Menandakan halaman saat ini -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <!-- Bagian utama konten untuk halaman ini -->
            <div class="container-fluid">
                <!-- Kontainer untuk memastikan responsif pada layar -->
                <div class="row">
                    <!-- Baris untuk menempatkan form pada kolom -->
                    <div class="col-lg-12">
                        <div class="card">
                            <!-- Card untuk menampung form -->
                            <div class="card-header bg-success text-white">
                                <!-- Header card dengan latar belakang hijau dan teks putih -->
                                <h4 class="card-title">Form Edit Pemeriksaan Pasien</h4>
                                <!-- Judul form -->
                            </div>
                            <div class="card-body">
                                <!-- Bagian isi card untuk form -->
                                <form action="{{ route('dokter.memeriksa.update', $periksa->id) }}" method="POST">
                                    <!-- Form untuk mengupdate data pemeriksaan pasien yang sudah ada -->
                                    @csrf
                                    @method('PUT')
                                    <!-- Token CSRF untuk keamanan dan method PUT untuk update data -->
                                    <input type="hidden" name="id_daftar_poli" value="{{ $periksa->daftarPoli->id }}">
                                    <!-- Menyembunyikan input ID daftar poli yang terkait dengan pemeriksaan pasien -->

                                    <div class="form-group">
                                        <label for="nama_pasien">Nama Pasien</label>
                                        <input type="text" name="nama_pasien" class="form-control"
                                            value="{{ $periksa->daftarPoli->pasien->nama }}" readonly>
                                        <!-- Menampilkan nama pasien yang tidak dapat diubah -->
                                    </div>

                                    <div class="form-group">
                                        <label for="no_rm">No RM</label>
                                        <input type="text" name="no_rm" class="form-control"
                                            value="{{ $periksa->daftarPoli->pasien->no_rm }}" readonly>
                                        <!-- Menampilkan nomor rekam medis pasien yang tidak dapat diubah -->
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_periksa">Tanggal Pemeriksaan</label>
                                        <input type="date" name="tgl_periksa" class="form-control"
                                            value="{{ $periksa->tgl_periksa }}" required>
                                        <!-- Menampilkan input tanggal pemeriksaan yang dapat diubah -->
                                    </div>

                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <textarea name="catatan" class="form-control" rows="3">{{ $periksa->catatan }}</textarea>
                                        <!-- Menampilkan textarea untuk catatan pemeriksaan yang dapat diubah -->
                                    </div>

                                    <div class="form-group">
                                        <label for="obat">Pilih Obat</label>
                                        <select name="obat[]" id="obat" class="form-control" multiple required>
                                            <!-- Dropdown untuk memilih obat yang dikaitkan dengan pemeriksaan, memungkinkan pemilihan beberapa obat -->
                                            @foreach ($obats as $obat)
                                                <option value="{{ $obat->id }}"
                                                    @if ($periksa->detailPeriksas->pluck('id_obat')->contains($obat->id)) selected @endif
                                                    data-price="{{ $obat->harga }}">
                                                    {{ $obat->nama_obat }} - Rp
                                                    {{ number_format($obat->harga, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- Menampilkan daftar obat yang tersedia dengan harga dan memungkinkan pemilihan ganda -->
                                    </div>

                                    <div class="form-group">
                                        <label for="harga_obat">Harga Obat</label>
                                        <input type="text" id="harga_obat" class="form-control" value="Rp 0" readonly>
                                        <!-- Menampilkan harga total obat yang dipilih, default 0 -->
                                    </div>

                                    <div class="form-group">
                                        <label for="biaya_periksa">Biaya Pemeriksaan</label>
                                        <input type="text" name="biaya_periksa" id="biaya_periksa" class="form-control"
                                            value="Rp 150.000" readonly>
                                        <!-- Menampilkan biaya pemeriksaan yang tetap -->
                                    </div>

                                    <div class="form-group">
                                        <label for="total_pembayaran">Total Pembayaran</label>
                                        <input type="text" id="total_pembayaran" class="form-control" value="Rp 150.000"
                                            readonly>
                                        <!-- Menampilkan total pembayaran, yang terdiri dari biaya pemeriksaan dan harga obat -->
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Simpan Pemeriksaan</button>
                                    <!-- Tombol untuk menyimpan perubahan pemeriksaan -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <!-- Menyertakan SweetAlert2 dan Select2 untuk interaksi user yang lebih baik -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 untuk input obat, memungkinkan pemilihan ganda
            $('#obat').select2({
                placeholder: "Pilih Obat", // Placeholder text
                allowClear: true, // Mengizinkan untuk menghapus pilihan
            });

            // Fungsi untuk menghitung harga obat yang dipilih dan total pembayaran
            function calculatePrice() {
                let selectedOptions = document.getElementById('obat').selectedOptions;
                let totalHargaObat = 0;

                // Iterasi melalui setiap opsi yang dipilih dan menambahkan harga obat
                for (let option of selectedOptions) {
                    totalHargaObat += parseInt(option.getAttribute('data-price'));
                }

                // Menampilkan total harga obat yang dipilih
                document.getElementById('harga_obat').value = 'Rp ' + totalHargaObat.toLocaleString();

                // Biaya pemeriksaan tetap adalah Rp 150.000
                let biayaPeriksa = 150000;

                // Menghitung total pembayaran sebagai jumlah biaya pemeriksaan dan harga obat
                let totalPembayaran = biayaPeriksa + totalHargaObat;

                // Menampilkan total pembayaran
                document.getElementById('total_pembayaran').value = 'Rp ' + totalPembayaran.toLocaleString();

                // Memperbarui biaya pemeriksaan di input
                document.getElementById('biaya_periksa').value = 'Rp ' + biayaPeriksa.toLocaleString();
            }

            // Event listener untuk mendeteksi perubahan pada pilihan obat
            $('#obat').on('change', function() {
                calculatePrice(); // Memanggil fungsi untuk menghitung harga dan total pembayaran
            });

            // Memanggil fungsi untuk pertama kali saat halaman dimuat agar harga dihitung
            calculatePrice();
        });
    </script>
@endpush
