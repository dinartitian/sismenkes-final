<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini dipanggil ketika seeder dijalankan untuk mengisi data ke dalam tabel 'obat'.
     * Setiap entri di tabel 'obat' berisi informasi tentang obat yang tersedia di apotek atau rumah sakit.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data obat pertama 'Paracetamol'
        Obat::create([
            'nama_obat' => 'Paracetamol', // Nama obat
            'kemasan' => 'Tablet', // Kemasan obat
            'harga' => 15000 // Harga obat
        ]);

        // Menambahkan data obat kedua 'Amoxicillin'
        Obat::create([
            'nama_obat' => 'Amoxicillin', // Nama obat
            'kemasan' => 'Kapsul', // Kemasan obat
            'harga' => 25000 // Harga obat
        ]);

        // Menambahkan data obat ketiga 'Ibuprofen'
        Obat::create([
            'nama_obat' => 'Ibuprofen', // Nama obat
            'kemasan' => 'Tablet', // Kemasan obat
            'harga' => 20000 // Harga obat
        ]);

        // Menambahkan data obat keempat 'Cetirizine'
        Obat::create([
            'nama_obat' => 'Cetirizine', // Nama obat
            'kemasan' => 'Tablet', // Kemasan obat
            'harga' => 18000 // Harga obat
        ]);

        // Menambahkan data obat kelima 'Aspirin'
        Obat::create([
            'nama_obat' => 'Aspirin', // Nama obat
            'kemasan' => 'Tablet', // Kemasan obat
            'harga' => 22000 // Harga obat
        ]);
    }
}
