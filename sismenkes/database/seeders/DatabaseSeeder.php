<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Fungsi ini dipanggil untuk menjalankan semua seeder yang telah didefinisikan.
     * Seeder ini digunakan untuk mengisi database dengan data awal yang diperlukan oleh aplikasi.
     * 
     * @return void
     */
    public function run(): void
    {
        // Menjalankan seeder untuk User dan tabel-tabel lainnya
        $this->call([  // Fungsi 'call' digunakan untuk menjalankan seeder lainnya secara berurutan.
            UserSeeder::class,          // Menjalankan seeder untuk tabel 'users' yang mengisi data pengguna.
            PoliSeeder::class,          // Menjalankan seeder untuk tabel 'poli' yang mengisi data poli.
            DokterSeeder::class,        // Menjalankan seeder untuk tabel 'dokter' yang mengisi data dokter.
            JadwalPeriksaSeeder::class, // Menjalankan seeder untuk tabel 'jadwal_periksa' yang mengisi jadwal pemeriksaan.
            PasienSeeder::class,        // Menjalankan seeder untuk tabel 'pasien' yang mengisi data pasien.
            DaftarPoliSeeder::class,    // Menjalankan seeder untuk tabel 'daftar_poli' yang mengisi data pendaftaran poli.
            PeriksaSeeder::class,       // Menjalankan seeder untuk tabel 'periksa' yang mengisi data pemeriksaan pasien.
            DetailPeriksaSeeder::class, // Menjalankan seeder untuk tabel 'detail_periksa' yang mengisi data detail pemeriksaan.
            ObatSeeder::class,          // Menjalankan seeder untuk tabel 'obat' yang mengisi data obat-obatan.
        ]);
    }
}
