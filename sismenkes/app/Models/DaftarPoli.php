<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    use HasFactory;

    // Definisikan nama tabel (jika berbeda dari nama model)
    protected $table = 'daftar_poli'; // Nama tabel yang digunakan di database (bukan 'daftar_polis', yang merupakan nama model)

    // Definisikan kolom yang bisa diisi secara massal
    protected $fillable = [
        'id_pasien',  // ID pasien yang mendaftar untuk poli
        'id_jadwal',  // ID jadwal periksa yang dipilih
        'keluhan',    // Keluhan pasien yang akan diperiksa
        'no_antrian'  // Nomor antrian pasien untuk jadwal tersebut
    ];

    // Relasi dengan Pasien (Many-to-One)
    public function pasien()
    {
        // Menghubungkan model DaftarPoli dengan model Pasien
        // Setiap pendaftaran poli milik satu pasien
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    // Relasi dengan JadwalPeriksa (Many-to-One)
    public function jadwalPeriksa()
    {
        // Menghubungkan model DaftarPoli dengan model JadwalPeriksa
        // Setiap pendaftaran poli terkait dengan satu jadwal periksa
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    // Relasi dengan Periksa (One-to-Many)
    public function periksas()
    {
        // Menghubungkan model DaftarPoli dengan model Periksa
        // Setiap pendaftaran poli dapat memiliki banyak pemeriksaan terkait (satu ke banyak)
        return $this->hasMany(Periksa::class, 'id_daftar_poli');
    }

    // Relasi dengan Dokter melalui JadwalPeriksa (Many-to-One)
    public function dokter()
    {
        // Menghubungkan model DaftarPoli dengan model Dokter melalui model JadwalPeriksa
        // Setiap pendaftaran poli terkait dengan dokter tertentu melalui jadwal periksa
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }
}
