<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model ini (jika berbeda dari nama model)
    protected $table = 'jadwal_periksa';

    // Menentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'id_dokter',   // ID dokter yang terjadwal
        'hari',         // Hari jadwal periksa
        'jam_mulai',    // Jam mulai jadwal periksa
        'jam_selesai',  // Jam selesai jadwal periksa
        'status',       // Status jadwal (aktif/nonaktif)
    ];

    /**
     * Relasi dengan Dokter (Many-to-One)
     * 
     * Fungsi ini mendefinisikan relasi **Many-to-One** antara jadwal periksa dan dokter.
     * Artinya, setiap jadwal periksa hanya bisa dimiliki oleh satu dokter.
     * Relasi ini diwakili dengan `belongsTo()` yang menunjukkan bahwa 
     * `jadwal_periksa` memiliki kolom `id_dokter` yang merujuk ke tabel `dokter`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    /**
     * Relasi dengan Poli (Many-to-One)
     * 
     * Fungsi ini mendefinisikan relasi **Many-to-One** antara jadwal periksa dan poli.
     * Setiap jadwal periksa terkait dengan satu poli.
     * Relasi ini diwakili dengan `belongsTo()` yang menunjukkan bahwa 
     * `jadwal_periksa` memiliki kolom `id_poli` yang merujuk ke tabel `poli`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    /**
     * Relasi dengan DaftarPoli (One-to-Many)
     * 
     * Fungsi ini mendefinisikan relasi **One-to-Many** antara jadwal periksa dan daftar poli.
     * Artinya, satu jadwal periksa dapat memiliki banyak pendaftaran poli (daftar pasien).
     * Relasi ini diwakili dengan `hasMany()`, yang menunjukkan bahwa 
     * `jadwal_periksa` memiliki banyak entri terkait di tabel `daftar_poli` berdasarkan kolom `id_jadwal`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal');
    }

    /**
     * Relasi dengan Periksa (One-to-Many)
     * 
     * Fungsi ini mendefinisikan relasi **One-to-Many** antara jadwal periksa dan pemeriksaan.
     * Artinya, satu jadwal periksa dapat memiliki banyak pemeriksaan terkait.
     * Relasi ini diwakili dengan `hasMany()`, yang menunjukkan bahwa 
     * `jadwal_periksa` memiliki banyak entri terkait di tabel `periksa` berdasarkan kolom `id_jadwal`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function periksas()
    {
        return $this->hasMany(Periksa::class, 'id_jadwal');
    }
}
