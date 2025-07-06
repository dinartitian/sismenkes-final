<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dijalankan untuk membuat tabel 'jadwal_periksa' di database.
     */
    public function up(): void
    {
        // Membuat tabel 'jadwal_periksa'
        Schema::create('jadwal_periksa', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom 'id' yang menjadi primary key tabel
            $table->foreignId('id_dokter')->constrained('dokter')->onDelete('cascade'); 
            // Kolom 'id_dokter' yang merujuk ke tabel 'dokter', dengan foreign key
            // Menggunakan onDelete('cascade'), yang berarti jika dokter dihapus, jadwal terkait juga akan dihapus secara otomatis.

            $table->string('hari', 10); // Kolom untuk menyimpan hari jadwal periksa dengan panjang maksimum 10 karakter
            $table->time('jam_mulai');  // Kolom untuk menyimpan jam mulai jadwal periksa
            $table->time('jam_selesai'); // Kolom untuk menyimpan jam selesai jadwal periksa
            $table->boolean('status')->default(true); 
            // Kolom 'status' untuk menyimpan status jadwal (aktif/inaktif). Default-nya adalah 'true' (aktif)

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
        // Menghapus tabel 'jadwal_periksa' jika migrasi dibatalkan
        Schema::dropIfExists('jadwal_periksa');
    }
};
