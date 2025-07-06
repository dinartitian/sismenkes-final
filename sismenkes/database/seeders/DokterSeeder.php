<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini dipanggil ketika seeder dijalankan untuk mengisi data ke dalam tabel 'dokter'.
     * Setiap entri di tabel 'dokter' berisi informasi tentang dokter yang terkait dengan poli tertentu.
     * 
     * @return void
     */
    public function run()
    {
        // Menambahkan data dokter pertama 'Dr. Andi' yang terkait dengan 'Poli Umum'
        Dokter::create([
            'nama' => 'Dr. Andi', // Nama dokter
            'alamat' => 'Jl. Sehat No. 1', // Alamat dokter
            'no_hp' => '08123456789', // Nomor handphone dokter
            'id_poli' => Poli::where('nama_poli', 'Poli Umum')->first()->id // Mengambil ID Poli Umum dari tabel 'poli'
        ]);

        // Menambahkan data dokter kedua 'Dr. Budi' yang terkait dengan 'Poli Gigi'
        Dokter::create([
            'nama' => 'Dr. Budi', // Nama dokter
            'alamat' => 'Jl. Gigi No. 2', // Alamat dokter
            'no_hp' => '08123456780', // Nomor handphone dokter
            'id_poli' => Poli::where('nama_poli', 'Poli Gigi')->first()->id // Mengambil ID Poli Gigi dari tabel 'poli'
        ]);

        // Menambahkan data dokter ketiga 'Dr. Citra' yang terkait dengan 'Poli Anak'
        Dokter::create([
            'nama' => 'Dr. Citra', // Nama dokter
            'alamat' => 'Jl. Anak No. 3', // Alamat dokter
            'no_hp' => '08123456781', // Nomor handphone dokter
            'id_poli' => Poli::where('nama_poli', 'Poli Anak')->first()->id // Mengambil ID Poli Anak dari tabel 'poli'
        ]);

        // Menambahkan data dokter keempat 'Dr. Dini' yang terkait dengan 'Poli Mata'
        Dokter::create([
            'nama' => 'Dr. Dini', // Nama dokter
            'alamat' => 'Jl. Mata No. 4', // Alamat dokter
            'no_hp' => '08123456782', // Nomor handphone dokter
            'id_poli' => Poli::where('nama_poli', 'Poli Mata')->first()->id // Mengambil ID Poli Mata dari tabel 'poli'
        ]);

        // Menambahkan data dokter kelima 'Dr. Eko' yang terkait dengan 'Poli Jantung'
        Dokter::create([
            'nama' => 'Dr. Eko', // Nama dokter
            'alamat' => 'Jl. Jantung No. 5', // Alamat dokter
            'no_hp' => '08123456783', // Nomor handphone dokter
            'id_poli' => Poli::where('nama_poli', 'Poli Jantung')->first()->id // Mengambil ID Poli Jantung dari tabel 'poli'
        ]);
    }
}
