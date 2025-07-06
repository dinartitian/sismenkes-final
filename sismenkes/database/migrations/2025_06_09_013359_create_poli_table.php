<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dijalankan untuk membuat tabel 'poli' di database.
     */
    public function up(): void
    {
        // Membuat tabel 'poli'
        Schema::create('poli', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom 'id' yang merupakan primary key
            $table->string('nama_poli', 25); // Kolom untuk nama poli, dengan panjang maksimum 25 karakter
            $table->text('keterangan'); // Kolom untuk keterangan atau deskripsi tentang poli
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at' otomatis
        });
    }

    /**
     * Reverse the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dibatalkan (rollback), untuk menghapus tabel yang telah dibuat.
     */
    public function down(): void
    {
        // Menghapus tabel 'poli' jika migrasi dibatalkan
        Schema::dropIfExists('poli');
    }
};
