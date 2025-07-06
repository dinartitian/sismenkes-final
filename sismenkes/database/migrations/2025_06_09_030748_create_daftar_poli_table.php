<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dijalankan untuk membuat tabel 'daftar_poli' di database.
     */
    public function up(): void
    {
        // Membuat tabel 'daftar_poli'
        Schema::create('daftar_poli', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom 'id' yang menjadi primary key tabel
            $table->foreignId('id_pasien')->constrained('pasien'); 
            // Kolom 'id_pasien' yang merujuk ke tabel 'pasien' sebagai foreign key
            // 'constrained()' secara otomatis menambahkan foreign key dan merujuk kolom 'id' pada tabel 'pasien'

            $table->foreignId('id_jadwal')->constrained('jadwal_periksa')->onDelete('cascade');  
            // Kolom 'id_jadwal' yang merujuk ke tabel 'jadwal_periksa' sebagai foreign key
            // 'onDelete('cascade')' memastikan bahwa jika jadwal periksa dihapus, entri terkait di 'daftar_poli' juga akan dihapus

            $table->text('keluhan'); // Kolom untuk menyimpan keluhan pasien yang mendaftar poli
            $table->integer('no_antrian'); // Kolom untuk menyimpan nomor antrian pasien untuk poli tertentu
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
        // Menghapus tabel 'daftar_poli' jika migrasi dibatalkan
        Schema::dropIfExists('daftar_poli');
    }
};
