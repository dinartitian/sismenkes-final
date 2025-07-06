<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dijalankan untuk membuat tabel 'detail_periksa' di database.
     */
    public function up()
    {
        // Membuat tabel 'detail_periksa'
        Schema::create('detail_periksa', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom 'id' yang menjadi primary key tabel
            $table->foreignId('id_periksa')->constrained('periksa');
            // Kolom 'id_periksa' yang merujuk ke tabel 'periksa' sebagai foreign key
            // 'constrained()' secara otomatis menambahkan foreign key dan merujuk kolom 'id' pada tabel 'periksa'

            $table->foreignId('id_obat')->constrained('obat');
            // Kolom 'id_obat' yang merujuk ke tabel 'obat' sebagai foreign key
            // 'constrained()' secara otomatis menambahkan foreign key dan merujuk kolom 'id' pada tabel 'obat'

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
        // Menghapus tabel 'detail_periksa' jika migrasi dibatalkan
        Schema::dropIfExists('detail_periksa');
    }
};
