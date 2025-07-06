<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISMENKES - Sistem Manajemen Kesehatan</title>

    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link ke FontAwesome (untuk ikon) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Background yang lebih bersih dengan warna biru */
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Menata container untuk menempatkan card di tengah */
        .card-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        /* Teks di dalam header dan deskripsi */
        .text-container {
            text-align: center;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #333;
        }

        p {
            font-size: 1.25rem;
            font-weight: 300;
            color: #777;
        }

        /* Menambahkan desain card */
        .card {
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 30px;
            text-align: center;
        }

        /* Menata ikon agar lebih menonjol */
        .card-body i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #007bff;
        }

        /* Desain tombol */
        .btn-light {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 30px;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-light:hover {
            background-color: #0056b3;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .row {
                flex-direction: column;
                gap: 15px;
            }

            h1 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>

<body>

    <!-- Kontainer untuk card yang akan ditampilkan di tengah -->
    <div class="container card-container">
        <!-- Judul SIMPOL -->
        <div class="text-container">
            <h1>SISMENKES (Sistem Manajemen Kesehatan)</h1>
            <p>Selamat datang di aplikasi SISMENKES. Silakan pilih salah satu menu di bawah ini.</p>
        </div>

        <div class="row text-center">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body text-dark">
                        <i class="fas fa-user-plus fa-3x mb-3"></i>
                        <h5 class="card-title">Daftar Pasien</h5>
                        <p class="card-text">Daftar sebagai pasien untuk mendapatkan akses ke layanan medis.</p>
                        <a href="{{ route('register') }}" class="btn btn-light">Daftar Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body text-dark">
                        <i class="fas fa-sign-in-alt fa-3x mb-3"></i>
                        <h5 class="card-title">Login Pasien</h5>
                        <p class="card-text">Login untuk mengakses riwayat pemeriksaan dan layanan lainnya.</p>
                        <a href="{{ route('pasien.login.form') }}" class="btn btn-light">Login Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body text-dark">
                        <i class="fas fa-user-md fa-3x mb-3"></i>
                        <h5 class="card-title">Login Dokter</h5>
                        <p class="card-text">Login untuk mengelola jadwal dan memeriksa pasien.</p>
                        <a href="{{ route('dokter.login.form') }}" class="btn btn-light">Login Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body text-dark">
                        <i class="fas fa-user-shield fa-3x mb-3"></i>
                        <h5 class="card-title">Login Admin</h5>
                        <p class="card-text">Login untuk mengelola data admin, dokter, pasien, dan obat.</p>
                        <a href="{{ route('login') }}" class="btn btn-light">Login Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Link ke Bootstrap JS dan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
