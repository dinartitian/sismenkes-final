<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Authenticatable
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model ini (jika berbeda dari nama model)
    protected $table = 'dokter';

    // Menentukan kolom yang bisa diisi secara massal
    protected $fillable = ['nama', 'alamat', 'no_hp', 'id_poli'];

    // Menambahkan guard untuk model Dokter agar berbeda dari pengguna biasa
    protected $guard = 'dokter';

    /**
     * Relasi Dokter dengan Poli (Many-to-One)
     * 
     * Fungsi ini mendefinisikan hubungan antara dokter dan poli.
     * Setiap dokter memiliki satu poli, dan hubungan ini menggunakan 
     * relasi **belongsTo**.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poli()
    {
        // Menghubungkan model Dokter dengan model Poli
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    /**
     * Override method untuk authentication tanpa password
     * 
     * Fungsi ini mengoverride method `getAuthPassword` yang digunakan oleh 
     * Laravel untuk autentikasi. Di sini, kita tidak menggunakan password
     * untuk login, melainkan menggunakan `nama` dan `alamat` untuk login.
     *
     * @return null
     */
    public function getAuthPassword()
    {
        return null; // Tidak ada password, karena kita menggunakan nama dan alamat untuk login
    }

    /**
     * Mendapatkan nama dari kolom yang digunakan sebagai identifier unik untuk pengguna.
     * 
     * Fungsi ini mengoverride `getAuthIdentifierName` yang digunakan oleh 
     * Laravel untuk mengambil nama kolom yang digunakan sebagai identifier
     * untuk login. Di sini kita menggunakan `id` sebagai identifier.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id'; // Kolom yang digunakan sebagai identifier dalam autentikasi
    }

    /**
     * Mendapatkan identifier unik untuk pengguna.
     * 
     * Fungsi ini mengoverride `getAuthIdentifier` yang digunakan untuk 
     * mendapatkan nilai unik dari kolom yang digunakan untuk autentikasi. 
     * Di sini, kita mengembalikan nilai `id` (primary key) dari model `Dokter`.
     *
     * @return int
     */
    public function getAuthIdentifier()
    {
        return $this->getKey(); // Mengembalikan nilai primary key (ID) dari model ini
    }

    /**
     * Relasi Dokter dengan JadwalPeriksa (One-to-Many)
     *
     * Fungsi ini mendefinisikan hubungan antara dokter dan jadwal pemeriksaan.
     * Seorang dokter bisa memiliki banyak jadwal pemeriksaan.
     * Relasi ini menggunakan **hasMany**, yang menunjukkan bahwa satu dokter
     * bisa memiliki banyak entri di tabel `jadwal_periksa`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwals()
    {
        // Menghubungkan model Dokter dengan model JadwalPeriksa
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }
}
