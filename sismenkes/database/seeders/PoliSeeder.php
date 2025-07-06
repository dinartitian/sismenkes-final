<?php

namespace Database\Seeders;
use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini dipanggil ketika seeder dijalankan untuk mengisi data ke dalam tabel 'poli'.
     * Setiap entri di tabel 'poli' berisi informasi tentang jenis poli yang tersedia di rumah sakit atau klinik.
     * 
     * @return void
     */
    public function run(): void
    {
        // Menambahkan data poli pertama 'Poli Umum'
        Poli::create([
            'nama_poli' => 'Poli Umum', // Nama poli
            'keterangan' => 'Melayani pemeriksaan umum', // Keterangan atau deskripsi tentang poli
        ]);

        // Menambahkan data poli kedua 'Poli Gigi'
        Poli::create([
            'nama_poli' => 'Poli Gigi', // Nama poli
            'keterangan' => 'Melayani pemeriksaan gigi', // Keterangan atau deskripsi tentang poli
        ]);

        // Menambahkan data poli ketiga 'Poli Anak'
        Poli::create([
            'nama_poli' => 'Poli Anak', // Nama poli
            'keterangan' => 'Melayani pemeriksaan anak', // Keterangan atau deskripsi tentang poli
        ]);

        // Menambahkan data poli keempat 'Poli Mata'
        Poli::create([
            'nama_poli' => 'Poli Mata', // Nama poli
            'keterangan' => 'Melayani pemeriksaan mata', // Keterangan atau deskripsi tentang poli
        ]);

        // Menambahkan data poli kelima 'Poli Jantung'
        Poli::create([
            'nama_poli' => 'Poli Jantung', // Nama poli
            'keterangan' => 'Melayani pemeriksaan jantung', // Keterangan atau deskripsi tentang poli
        ]);
    }
}
