<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dijalankan untuk memodifikasi tabel 'detail_periksa' di database.
     */
    public function up()
    {
        // Memodifikasi tabel 'detail_periksa'
        Schema::table('detail_periksa', function (Blueprint $table) {
            // Menghapus foreign key lama pada kolom 'id_obat'
            $table->dropForeign(['id_obat']);

            // Memastikan kolom 'id_obat' adalah unsignedBigInteger dan nullable
            // Ini digunakan untuk memastikan bahwa kolom dapat menampung nilai null dan tipe data sesuai
            $table->unsignedBigInteger('id_obat')->nullable()->change();

            // Menambahkan foreign key constraint pada kolom 'id_obat' dengan onDelete('set null')
            // Artinya, jika data pada tabel 'obat' yang terkait dihapus, maka kolom 'id_obat' di tabel 'detail_periksa' akan diset null
            $table->foreign('id_obat')->references('id')->on('obat')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dibatalkan (rollback), untuk mengembalikan perubahan yang telah dilakukan.
     */
    public function down()
    {
        // Memodifikasi tabel 'detail_periksa' untuk membalikkan perubahan yang telah dilakukan di fungsi 'up()'
        Schema::table('detail_periksa', function (Blueprint $table) {
            // Menghapus foreign key yang telah ditambahkan pada kolom 'id_obat'
            $table->dropForeign(['id_obat']);

            // Menambahkan foreign key kembali tanpa onDelete('set null')
            // Artinya, jika data pada tabel 'obat' yang terkait dihapus, maka tidak ada perubahan pada kolom 'id_obat'
            $table->foreign('id_obat')->references('id')->on('obat');
        });
    }
};
