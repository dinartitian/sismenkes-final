<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dijalankan untuk memodifikasi tabel 'jadwal_periksa' di database.
     */
    public function up()
    {
        // Memodifikasi tabel 'jadwal_periksa' untuk memperbarui foreign key pada kolom 'id_dokter'
        Schema::table('jadwal_periksa', function (Blueprint $table) {
            // Menghapus foreign key lama pada kolom 'id_dokter'
            $table->dropForeign(['id_dokter']);
            
            // Menambahkan foreign key baru dengan cascade delete
            $table->foreign('id_dokter') // Menambahkan foreign key pada kolom 'id_dokter'
                ->references('id')        // Merujuk ke kolom 'id' di tabel 'dokter'
                ->on('dokter')            // Tabel 'dokter' adalah tabel yang dirujuk
                ->onDelete('cascade');    // Menambahkan 'onDelete' dengan opsi 'cascade', memastikan jadwal periksa yang terkait dihapus jika dokter dihapus
        });
    }

    /**
     * Reverse the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dibatalkan (rollback), untuk mengembalikan perubahan yang telah dilakukan.
     */
    public function down()
    {
        // Memodifikasi tabel 'jadwal_periksa' untuk menghapus foreign key yang telah diubah
        Schema::table('jadwal_periksa', function (Blueprint $table) {
            // Menghapus foreign key yang telah ditambahkan pada kolom 'id_dokter'
            $table->dropForeign(['id_dokter']);
            
            // Menambahkan kembali foreign key pada kolom 'id_dokter' tanpa 'onDelete' cascade
            $table->foreign('id_dokter') // Menambahkan foreign key pada kolom 'id_dokter'
                ->references('id')        // Merujuk ke kolom 'id' di tabel 'dokter'
                ->on('dokter');           // Tabel 'dokter' adalah tabel yang dirujuk
        });
    }
};
