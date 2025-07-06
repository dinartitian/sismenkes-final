@extends('layouts.app')
<!-- Menggunakan layout utama 'app' dari file layouts.app untuk menyusun struktur halaman ini -->

@section('title', 'Periksa Pasien')
<!-- Menetapkan judul halaman di browser menjadi 'Periksa Pasien' -->

@section('content')
    <!-- Bagian konten halaman utama -->

    <main class="app-main">
        <!-- Elemen utama untuk aplikasi, yang membungkus seluruh konten utama halaman -->

        <div class="app-content-header">
            <!-- Header bagian konten untuk menampilkan judul dan breadcrumb -->
            <div class="container-fluid">
                <!-- Kontainer untuk memastikan responsif pada layar -->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Periksa Pasien</h3>
                        <!-- Judul halaman -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <!-- Menampilkan breadcrumb untuk navigasi -->
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                            <!-- Tautan ke dashboard dokter -->
                            <li class="breadcrumb-item"><a href="{{ route('dokter.memeriksa.index') }}">Jadwal Memeriksa</a>
                            </li>
                            <!-- Tautan ke halaman daftar jadwal memeriksa -->
                            <li class="breadcrumb-item active" aria-current="page">Periksa Pasien</li>
                            <!-- Menandakan halaman saat ini -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <!-- Kontainer utama untuk konten halaman -->

                <div class="row">
                    <!-- Baris untuk menampilkan form pemeriksaan pasien -->
                    <div class="col-lg-12">
                        <div class="card">
                            <!-- Card untuk menampung form pemeriksaan -->
                            <div class="card-header bg-success text-white">
                                <!-- Header card dengan latar belakang hijau dan teks putih -->
                                <h4 class="card-title">Form Pemeriksaan Pasien</h4>
                                <!-- Judul form -->
                            </div>
                            <div class="card-body">
                                <!-- Bagian isi card untuk menampilkan form -->
                                <form action="{{ route('dokter.memeriksa.store') }}" method="POST">
                                    <!-- Formulir untuk menyimpan data pemeriksaan pasien -->
                                    @csrf
                                    <!-- Token CSRF untuk melindungi form dari serangan CSRF -->
                                    <input type="hidden" name="id_daftar_poli" value="{{ $daftarPoli->id }}">
                                    <!-- Menyembunyikan input ID daftar poli yang terkait dengan pasien -->

                                    <div class="form-group">
                                        <label for="nama_pasien">Nama Pasien</label>
                                        <input type="text" name="nama_pasien" class="form-control"
                                            value="{{ $daftarPoli->pasien->nama }}" readonly>
                                        <!-- Menampilkan nama pasien yang tidak dapat diubah -->
                                    </div>

                                    <div class="form-group">
                                        <label for="no_rm">No RM</label>
                                        <input type="text" name="no_rm" class="form-control"
                                            value="{{ $daftarPoli->pasien->no_rm }}" readonly>
                                        <!-- Menampilkan nomor rekam medis pasien yang tidak dapat diubah -->
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_periksa">Tanggal Pemeriksaan</label>
                                        <input type="date" name="tgl_periksa" class="form-control" required>
                                        <!-- Menampilkan input tanggal pemeriksaan yang dapat diubah -->
                                    </div>

                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <textarea name="catatan" class="form-control" rows="3"></textarea>
                                        <!-- Menampilkan textarea untuk catatan pemeriksaan yang dapat diubah -->
                                    </div>

                                    <div class="form-group">
                                        <label for="obat">Pilih Obat</label>
                                        <select name="obat[]" id="obat" class="form-control" multiple required>
                                            <!-- Dropdown untuk memilih obat yang akan diberikan pada pasien -->
                                            @foreach ($obats as $obat)
                                                <option value="{{ $obat->id }}" data-price="{{ $obat->harga }}">
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
                                        <!-- Menampilkan harga total obat yang dipilih -->
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
                                        <!-- Menampilkan total pembayaran yang terdiri dari biaya pemeriksaan dan harga obat -->
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Simpan Pemeriksaan</button>
                                    <!-- Tombol untuk menyimpan perubahan pemeriksaan pasien -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
<!-- Menutup bagian konten halaman utama -->

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
