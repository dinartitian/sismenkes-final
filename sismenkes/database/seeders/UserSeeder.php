<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini dipanggil ketika seeder dijalankan untuk mengisi data ke dalam tabel 'users'.
     * Setiap entri di tabel 'users' berisi informasi tentang pengguna aplikasi (seperti admin dan user biasa).
     *
     * @return void
     */
    public function run()
    {
        // Membuat admin user dengan nama, email, dan password
        User::create([
            'name' => 'Admin Sismenkes', // Nama pengguna admin
            'email' => 'admin@example.com', // Email pengguna admin
            'password' => Hash::make('password123'), // Password untuk pengguna admin yang sudah di-hash
        ]);
    }
}
