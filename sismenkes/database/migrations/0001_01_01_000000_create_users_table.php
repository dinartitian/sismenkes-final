<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dijalankan untuk membuat tabel-tabel di database.
     */
    public function up(): void
    {
        // Membuat tabel 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom 'id' yang merupakan primary key
            $table->string('name'); // Kolom untuk menyimpan nama pengguna
            $table->string('email')->unique(); // Kolom untuk menyimpan email pengguna, yang bersifat unik
            $table->timestamp('email_verified_at')->nullable(); // Kolom untuk mencatat waktu verifikasi email, bisa kosong
            $table->string('password'); // Kolom untuk menyimpan password pengguna
            $table->rememberToken(); // Kolom untuk menyimpan token 'remember me' pada autentikasi
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });

        // Membuat tabel 'password_reset_tokens' untuk menyimpan token reset password
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Kolom email yang juga menjadi primary key
            $table->string('token'); // Kolom untuk menyimpan token reset password
            $table->timestamp('created_at')->nullable(); // Kolom untuk mencatat waktu pembuatan token, bisa kosong
        });

        // Membuat tabel 'sessions' untuk menyimpan data sesi pengguna
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Kolom 'id' yang menjadi primary key sesi
            $table->foreignId('user_id')->nullable()->index(); // Kolom 'user_id' untuk merujuk ke pengguna, bisa kosong, diindeks
            $table->string('ip_address', 45)->nullable(); // Kolom untuk menyimpan alamat IP pengguna, bisa kosong
            $table->text('user_agent')->nullable(); // Kolom untuk menyimpan user-agent dari browser pengguna, bisa kosong
            $table->longText('payload'); // Kolom untuk menyimpan data payload sesi
            $table->integer('last_activity')->index(); // Kolom untuk menyimpan waktu aktivitas terakhir, diindeks
        });
    }

    /**
     * Reverse the migrations.
     * 
     * Fungsi ini dipanggil ketika migrasi dibatalkan (rollback), untuk menghapus tabel-tabel yang telah dibuat.
     */
    public function down(): void
    {
        // Menghapus tabel 'users' jika migrasi dibatalkan
        Schema::dropIfExists('users');
        
        // Menghapus tabel 'password_reset_tokens' jika migrasi dibatalkan
        Schema::dropIfExists('password_reset_tokens');
        
        // Menghapus tabel 'sessions' jika migrasi dibatalkan
        Schema::dropIfExists('sessions');
    }
};
