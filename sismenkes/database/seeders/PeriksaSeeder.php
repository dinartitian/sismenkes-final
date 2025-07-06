<?php

namespace Database\Seeders;

use App\Models\Periksa;
use App\Models\DaftarPoli;
use Illuminate\Database\Seeder;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini dipanggil ketika seeder dijalankan untuk mengisi data ke dalam tabel 'periksa'.
     * Setiap entri di tabel 'periksa' berisi informasi tentang pemeriksaan yang dilakukan pada pasien.
     * 
     * @return void
     */
    public function run()
    {
        // Menambahkan data pemeriksaan pertama yang terkait dengan pasien dengan nomor antrian 1
        Periksa::create([
            'id_daftar_poli' => DaftarPoli::where('no_antrian', 1)->first()->id, // Mendapatkan ID pendaftaran poli berdasarkan nomor antrian
            'tgl_periksa' => '2023-06-01', // Menetapkan tanggal pemeriksaan
            'catatan' => 'Pasien datang dengan keluhan batuk', // Catatan pemeriksaan pasien
            'biaya_periksa' => 50000 // Biaya pemeriksaan
        ]);

        // Menambahkan data pemeriksaan kedua yang terkait dengan pasien dengan nomor antrian 2
        Periksa::create([
            'id_daftar_poli' => DaftarPoli::where('no_antrian', 2)->first()->id, // Mendapatkan ID pendaftaran poli berdasarkan nomor antrian
            'tgl_periksa' => '2023-06-02', // Menetapkan tanggal pemeriksaan
            'catatan' => 'Pasien sakit gigi', // Catatan pemeriksaan pasien
            'biaya_periksa' => 75000 // Biaya pemeriksaan
        ]);

        // Menambahkan data pemeriksaan ketiga yang terkait dengan pasien dengan nomor antrian 3
        Periksa::create([
            'id_daftar_poli' => DaftarPoli::where('no_antrian', 3)->first()->id, // Mendapatkan ID pendaftaran poli berdasarkan nomor antrian
            'tgl_periksa' => '2023-06-03', // Menetapkan tanggal pemeriksaan
            'catatan' => 'Pasien demam tinggi', // Catatan pemeriksaan pasien
            'biaya_periksa' => 60000 // Biaya pemeriksaan
        ]);

        // Menambahkan data pemeriksaan keempat yang terkait dengan pasien dengan nomor antrian 4
        Periksa::create([
            'id_daftar_poli' => DaftarPoli::where('no_antrian', 4)->first()->id, // Mendapatkan ID pendaftaran poli berdasarkan nomor antrian
            'tgl_periksa' => '2023-06-04', // Menetapkan tanggal pemeriksaan
            'catatan' => 'Pasien keluhan gangguan penglihatan', // Catatan pemeriksaan pasien
            'biaya_periksa' => 70000 // Biaya pemeriksaan
        ]);

        // Menambahkan data pemeriksaan kelima yang terkait dengan pasien dengan nomor antrian 5
        Periksa::create([
            'id_daftar_poli' => DaftarPoli::where('no_antrian', 5)->first()->id, // Mendapatkan ID pendaftaran poli berdasarkan nomor antrian
            'tgl_periksa' => '2023-06-05', // Menetapkan tanggal pemeriksaan
            'catatan' => 'Pasien keluhan nyeri dada', // Catatan pemeriksaan pasien
            'biaya_periksa' => 80000 // Biaya pemeriksaan
        ]);
    }
}
