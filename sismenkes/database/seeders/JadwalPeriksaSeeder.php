<?php

namespace Database\Seeders;

use App\Models\JadwalPeriksa;
use App\Models\Dokter;
use Illuminate\Database\Seeder;

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini dipanggil ketika seeder dijalankan untuk mengisi data ke dalam tabel 'jadwal_periksa'.
     * Setiap entri di tabel 'jadwal_periksa' berisi informasi tentang jadwal pemeriksaan yang dimiliki oleh dokter tertentu.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan jadwal pemeriksaan untuk dokter 'Dr. Andi'
        JadwalPeriksa::create([
            'id_dokter' => Dokter::where('nama', 'Dr. Andi')->first()->id, // Mengambil ID dokter berdasarkan nama
            'hari' => 'Senin', // Menetapkan hari pemeriksaan
            'jam_mulai' => '08:00:00', // Menetapkan jam mulai pemeriksaan
            'jam_selesai' => '12:00:00', // Menetapkan jam selesai pemeriksaan
            'status' => true,  // Menambahkan status jadwal (aktif)
        ]);

        // Menambahkan jadwal pemeriksaan untuk dokter 'Dr. Budi'
        JadwalPeriksa::create([
            'id_dokter' => Dokter::where('nama', 'Dr. Budi')->first()->id, // Mengambil ID dokter berdasarkan nama
            'hari' => 'Selasa', // Menetapkan hari pemeriksaan
            'jam_mulai' => '09:00:00', // Menetapkan jam mulai pemeriksaan
            'jam_selesai' => '13:00:00', // Menetapkan jam selesai pemeriksaan
            'status' => true,  // Menambahkan status jadwal (aktif)
        ]);

        // Menambahkan jadwal pemeriksaan untuk dokter 'Dr. Citra'
        JadwalPeriksa::create([
            'id_dokter' => Dokter::where('nama', 'Dr. Citra')->first()->id, // Mengambil ID dokter berdasarkan nama
            'hari' => 'Rabu', // Menetapkan hari pemeriksaan
            'jam_mulai' => '10:00:00', // Menetapkan jam mulai pemeriksaan
            'jam_selesai' => '14:00:00', // Menetapkan jam selesai pemeriksaan
            'status' => false,  // Menambahkan status jadwal (tidak aktif)
        ]);

        // Menambahkan jadwal pemeriksaan untuk dokter 'Dr. Dini'
        JadwalPeriksa::create([
            'id_dokter' => Dokter::where('nama', 'Dr. Dini')->first()->id, // Mengambil ID dokter berdasarkan nama
            'hari' => 'Kamis', // Menetapkan hari pemeriksaan
            'jam_mulai' => '11:00:00', // Menetapkan jam mulai pemeriksaan
            'jam_selesai' => '15:00:00', // Menetapkan jam selesai pemeriksaan
            'status' => true,  // Menambahkan status jadwal (aktif)
        ]);

        // Menambahkan jadwal pemeriksaan untuk dokter 'Dr. Eko'
        JadwalPeriksa::create([
            'id_dokter' => Dokter::where('nama', 'Dr. Eko')->first()->id, // Mengambil ID dokter berdasarkan nama
            'hari' => 'Jumat', // Menetapkan hari pemeriksaan
            'jam_mulai' => '07:00:00', // Menetapkan jam mulai pemeriksaan
            'jam_selesai' => '11:00:00', // Menetapkan jam selesai pemeriksaan
            'status' => false,  // Menambahkan status jadwal (tidak aktif)
        ]);
    }
}
