<?php

namespace Database\Seeders;

use App\Models\DaftarPoli;
use App\Models\Pasien;
use App\Models\JadwalPeriksa;
use Illuminate\Database\Seeder;

class DaftarPoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini dipanggil ketika seeder dijalankan untuk mengisi data ke dalam tabel 'daftar_poli'.
     * Fungsi ini akan menambahkan beberapa data pendaftaran poli ke dalam tabel 'daftar_poli'.
     * 
     * @return void
     */
    public function run()
    {
        // Menambahkan data pendaftaran poli untuk pasien 'Siti Aisyah'
        DaftarPoli::create([
            'id_pasien' => Pasien::where('nama', 'Siti Aisyah')->first()->id, // Mendapatkan ID pasien berdasarkan nama
            'id_jadwal' => JadwalPeriksa::where('id_dokter', 1)->first()->id, // Mendapatkan ID jadwal berdasarkan ID dokter
            'keluhan' => 'Batuk parah', // Menambahkan keluhan pasien
            'no_antrian' => 1 // Menentukan nomor antrian pasien
        ]);

        // Menambahkan data pendaftaran poli untuk pasien 'Budi Santoso'
        DaftarPoli::create([
            'id_pasien' => Pasien::where('nama', 'Budi Santoso')->first()->id, // Mendapatkan ID pasien berdasarkan nama
            'id_jadwal' => JadwalPeriksa::where('id_dokter', 2)->first()->id, // Mendapatkan ID jadwal berdasarkan ID dokter
            'keluhan' => 'Sakit gigi', // Menambahkan keluhan pasien
            'no_antrian' => 2 // Menentukan nomor antrian pasien
        ]);

        // Menambahkan data pendaftaran poli untuk pasien 'Andi Pratama'
        DaftarPoli::create([
            'id_pasien' => Pasien::where('nama', 'Andi Pratama')->first()->id, // Mendapatkan ID pasien berdasarkan nama
            'id_jadwal' => JadwalPeriksa::where('id_dokter', 3)->first()->id, // Mendapatkan ID jadwal berdasarkan ID dokter
            'keluhan' => 'Demam tinggi', // Menambahkan keluhan pasien
            'no_antrian' => 3 // Menentukan nomor antrian pasien
        ]);

        // Menambahkan data pendaftaran poli untuk pasien 'Dewi Lestari'
        DaftarPoli::create([
            'id_pasien' => Pasien::where('nama', 'Dewi Lestari')->first()->id, // Mendapatkan ID pasien berdasarkan nama
            'id_jadwal' => JadwalPeriksa::where('id_dokter', 4)->first()->id, // Mendapatkan ID jadwal berdasarkan ID dokter
            'keluhan' => 'Gangguan penglihatan', // Menambahkan keluhan pasien
            'no_antrian' => 4 // Menentukan nomor antrian pasien
        ]);

        // Menambahkan data pendaftaran poli untuk pasien 'Rudi Setiawan'
        DaftarPoli::create([
            'id_pasien' => Pasien::where('nama', 'Rudi Setiawan')->first()->id, // Mendapatkan ID pasien berdasarkan nama
            'id_jadwal' => JadwalPeriksa::where('id_dokter', 5)->first()->id, // Mendapatkan ID jadwal berdasarkan ID dokter
            'keluhan' => 'Nyeri dada', // Menambahkan keluhan pasien
            'no_antrian' => 5 // Menentukan nomor antrian pasien
        ]);
    }
}
