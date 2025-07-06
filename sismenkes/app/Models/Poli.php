<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    // Definisikan nama tabel (jika berbeda dari nama model)
    protected $table = 'poli';  // Nama tabel yang digunakan di database, yaitu 'poli'

    // Definisikan kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_poli',  // Nama poli (misalnya: Poli Anak, Poli Gigi, dll)
        'keterangan'  // Keterangan atau deskripsi tentang poli tersebut
    ];

    /**
     * Relasi dengan Dokter (One-to-Many)
     * 
     * Fungsi ini mendefinisikan relasi **One-to-Many** antara model Poli dan model Dokter.
     * Artinya, satu poli dapat memiliki banyak dokter yang terkait. 
     * Relasi ini diwakili dengan `hasMany()`, yang menunjukkan bahwa satu entri di tabel `poli` 
     * dapat memiliki banyak entri terkait di tabel `dokter`, dengan kolom `id_poli` di tabel `dokter` 
     * merujuk ke `id` di tabel `poli`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dokters()
    {
        return $this->hasMany(Dokter::class, 'id_poli');
    }

    /**
     * Relasi dengan JadwalPeriksa (One-to-Many)
     * 
     * Fungsi ini mendefinisikan relasi **One-to-Many** antara model Poli dan model JadwalPeriksa.
     * Artinya, satu poli dapat memiliki banyak jadwal pemeriksaan terkait. 
     * Relasi ini diwakili dengan `hasMany()`, yang menunjukkan bahwa satu entri di tabel `poli` 
     * dapat memiliki banyak entri terkait di tabel `jadwal_periksa`, dengan kolom `id_poli` di tabel `jadwal_periksa` 
     * merujuk ke `id` di tabel `poli`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwalPeriksas()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_poli');
    }
}
