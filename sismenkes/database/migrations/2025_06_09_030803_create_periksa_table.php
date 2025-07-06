<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dijalankan untuk membuat tabel 'periksa' di database.
     */
    public function up(): void
    {
        // Membuat tabel 'periksa'
        Schema::create('periksa', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom 'id' yang menjadi primary key tabel
            $table->foreignId('id_daftar_poli')
                ->constrained('daftar_poli')
                ->onDelete('cascade');  
            // Kolom 'id_daftar_poli' yang merujuk ke tabel 'daftar_poli' sebagai foreign key
            // 'constrained()' secara otomatis menambahkan foreign key dan merujuk kolom 'id' pada tabel 'daftar_poli'
            // 'onDelete('cascade')' memastikan bahwa jika pendaftaran poli dihapus, pemeriksaan terkait juga akan dihapus

            $table->date('tgl_periksa'); // Kolom untuk menyimpan tanggal pemeriksaan
            $table->text('catatan'); // Kolom untuk menyimpan catatan terkait pemeriksaan
            $table->integer('biaya_periksa'); // Kolom untuk menyimpan biaya pemeriksaan
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
        // Menghapus tabel 'periksa' jika migrasi dibatalkan
        Schema::dropIfExists('periksa');
    }
};
