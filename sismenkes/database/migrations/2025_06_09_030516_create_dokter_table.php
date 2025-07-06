<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dijalankan untuk membuat tabel 'dokter' di database.
     */
    public function up(): void
    {
        // Membuat tabel 'dokter'
        Schema::create('dokter', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom 'id' yang menjadi primary key tabel
            $table->string('nama', 150); // Kolom untuk menyimpan nama dokter dengan panjang maksimum 150 karakter
            $table->string('alamat', 255); // Kolom untuk menyimpan alamat dokter dengan panjang maksimum 255 karakter
            $table->bigInteger('no_hp'); // Kolom untuk menyimpan nomor handphone dokter
            $table->foreignId('id_poli')->constrained('poli'); // Menambahkan kolom 'id_poli' yang merupakan foreign key yang merujuk ke tabel 'poli'
            $table->timestamps(); // Kolom created_at dan updated_at otomatis ditambahkan
        });
    }

    /**
     * Reverse the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dibatalkan (rollback), untuk menghapus tabel yang telah dibuat.
     */
    public function down(): void
    {
        // Menghapus tabel 'dokter' jika migrasi dibatalkan
        Schema::dropIfExists('dokter');
    }
};
