<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dijalankan untuk membuat tabel 'pasien' di database.
     */
    public function up(): void
    {
        // Membuat tabel 'pasien'
        Schema::create('pasien', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom 'id' yang menjadi primary key tabel
            $table->string('nama', 150); // Kolom untuk menyimpan nama pasien dengan panjang maksimum 150 karakter
            $table->string('alamat', 255); // Kolom untuk menyimpan alamat pasien dengan panjang maksimum 255 karakter
            $table->bigInteger('no_ktp'); // Kolom untuk menyimpan nomor KTP pasien (menggunakan bigInteger karena nomor KTP bisa panjang)
            $table->bigInteger('no_hp'); // Kolom untuk menyimpan nomor handphone pasien
            $table->char('no_rm', 10); // Kolom untuk menyimpan nomor rekam medis (no_rm) pasien, dengan panjang 10 karakter
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at' otomatis ditambahkan oleh Laravel
        });
    }

    /**
     * Reverse the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dibatalkan (rollback), untuk menghapus tabel yang telah dibuat.
     */
    public function down(): void
    {
        // Menghapus tabel 'pasien' jika migrasi dibatalkan
        Schema::dropIfExists('pasien');
    }
};
