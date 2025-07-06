<?php

namespace Database\Seeders;

use App\Models\DetailPeriksa;
use App\Models\Periksa;
use App\Models\Obat;
use Illuminate\Database\Seeder;

class DetailPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini dipanggil untuk mengisi data ke dalam tabel 'detail_periksa'.
     * Setiap entri di tabel 'detail_periksa' menghubungkan pemeriksaan dengan obat yang diberikan kepada pasien.
     * 
     * @return void
     */
    public function run()
    {
        // Menambahkan data ke tabel 'detail_periksa' untuk pemeriksaan dengan biaya_periksa 50000
        $periksa1 = Periksa::where('biaya_periksa', 50000)->first(); // Mencari pemeriksaan dengan biaya 50000
        if ($periksa1) { // Jika pemeriksaan ditemukan
            DetailPeriksa::create([ // Menambahkan data ke tabel 'detail_periksa'
                'id_periksa' => $periksa1->id, // Menyimpan ID pemeriksaan
                'id_obat' => Obat::where('nama_obat', 'Paracetamol')->first()->id // Menyimpan ID obat 'Paracetamol'
            ]);
        }

        // Menambahkan data ke tabel 'detail_periksa' untuk pemeriksaan dengan biaya_periksa 75000
        $periksa2 = Periksa::where('biaya_periksa', 75000)->first(); // Mencari pemeriksaan dengan biaya 75000
        if ($periksa2) { // Jika pemeriksaan ditemukan
            DetailPeriksa::create([ // Menambahkan data ke tabel 'detail_periksa'
                'id_periksa' => $periksa2->id, // Menyimpan ID pemeriksaan
                'id_obat' => Obat::where('nama_obat', 'Amoxicillin')->first()->id // Menyimpan ID obat 'Amoxicillin'
            ]);
        }

        // Menambahkan data ke tabel 'detail_periksa' untuk pemeriksaan dengan biaya_periksa 60000
        $periksa3 = Periksa::where('biaya_periksa', 60000)->first(); // Mencari pemeriksaan dengan biaya 60000
        if ($periksa3) { // Jika pemeriksaan ditemukan
            DetailPeriksa::create([ // Menambahkan data ke tabel 'detail_periksa'
                'id_periksa' => $periksa3->id, // Menyimpan ID pemeriksaan
                'id_obat' => Obat::where('nama_obat', 'Ibuprofen')->first()->id // Menyimpan ID obat 'Ibuprofen'
            ]);
        }

        // Menambahkan data ke tabel 'detail_periksa' untuk pemeriksaan dengan biaya_periksa 70000
        $periksa4 = Periksa::where('biaya_periksa', 70000)->first(); // Mencari pemeriksaan dengan biaya 70000
        if ($periksa4) { // Jika pemeriksaan ditemukan
            DetailPeriksa::create([ // Menambahkan data ke tabel 'detail_periksa'
                'id_periksa' => $periksa4->id, // Menyimpan ID pemeriksaan
                'id_obat' => Obat::where('nama_obat', 'Cetirizine')->first()->id // Menyimpan ID obat 'Cetirizine'
            ]);
        }

        // Menambahkan data ke tabel 'detail_periksa' untuk pemeriksaan dengan biaya_periksa 80000
        $periksa5 = Periksa::where('biaya_periksa', 80000)->first(); // Mencari pemeriksaan dengan biaya 80000
        if ($periksa5) { // Jika pemeriksaan ditemukan
            DetailPeriksa::create([ // Menambahkan data ke tabel 'detail_periksa'
                'id_periksa' => $periksa5->id, // Menyimpan ID pemeriksaan
                'id_obat' => Obat::where('nama_obat', 'Aspirin')->first()->id // Menyimpan ID obat 'Aspirin'
            ]);
        }
    }
}
