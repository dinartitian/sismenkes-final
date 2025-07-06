<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dijalankan untuk membuat tabel 'obat' di database.
     */
    public function up()
    {
        // Membuat tabel 'obat'
        Schema::create('obat', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom 'id' yang menjadi primary key tabel 'obat'. Kolom 'id' ini secara otomatis menggunakan tipe BIGINT UNSIGNED
            $table->string('nama_obat', 50); // Kolom untuk menyimpan nama obat dengan panjang maksimal 50 karakter
            $table->string('kemasan', 35); // Kolom untuk menyimpan informasi kemasan obat dengan panjang maksimal 35 karakter
            $table->integer('harga'); // Kolom untuk menyimpan harga obat (tipe data integer)
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
        // Menghapus tabel 'obat' jika migrasi dibatalkan
        Schema::dropIfExists('obat');
    }
};
