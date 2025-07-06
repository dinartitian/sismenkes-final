<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini dipanggil ketika seeder dijalankan untuk mengisi data ke dalam tabel 'pasien'.
     * Setiap entri di tabel 'pasien' berisi informasi tentang pasien yang terdaftar di sistem.
     * 
     * @return void
     */
    public function run()
    {
        // Menambahkan data pasien pertama 'Siti Aisyah'
        Pasien::create([
            'nama' => 'Siti Aisyah', // Nama pasien
            'alamat' => 'Jl. Mawar No. 10', // Alamat pasien
            'no_ktp' => '1234567890', // Nomor KTP pasien
            'no_hp' => '08123456789', // Nomor handphone pasien
            'no_rm' => 'P0001' // Nomor rekam medis pasien
        ]);

        // Menambahkan data pasien kedua 'Budi Santoso'
        Pasien::create([
            'nama' => 'Budi Santoso', // Nama pasien
            'alamat' => 'Jl. Melati No. 12', // Alamat pasien
            'no_ktp' => '2345678901', // Nomor KTP pasien
            'no_hp' => '08123456780', // Nomor handphone pasien
            'no_rm' => 'P0002' // Nomor rekam medis pasien
        ]);

        // Menambahkan data pasien ketiga 'Andi Pratama'
        Pasien::create([
            'nama' => 'Andi Pratama', // Nama pasien
            'alamat' => 'Jl. Anggrek No. 15', // Alamat pasien
            'no_ktp' => '3456789012', // Nomor KTP pasien
            'no_hp' => '08123456781', // Nomor handphone pasien
            'no_rm' => 'P0003' // Nomor rekam medis pasien
        ]);

        // Menambahkan data pasien keempat 'Dewi Lestari'
        Pasien::create([
            'nama' => 'Dewi Lestari', // Nama pasien
            'alamat' => 'Jl. Kenanga No. 17', // Alamat pasien
            'no_ktp' => '4567890123', // Nomor KTP pasien
            'no_hp' => '08123456782', // Nomor handphone pasien
            'no_rm' => 'P0004' // Nomor rekam medis pasien
        ]);

        // Menambahkan data pasien kelima 'Rudi Setiawan'
        Pasien::create([
            'nama' => 'Rudi Setiawan', // Nama pasien
            'alamat' => 'Jl. Cempaka No. 8', // Alamat pasien
            'no_ktp' => '5678901234', // Nomor KTP pasien
            'no_hp' => '08123456783', // Nomor handphone pasien
            'no_rm' => 'P0005' // Nomor rekam medis pasien
        ]);
    }
}
