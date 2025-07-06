<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    // Definisikan nama tabel (jika berbeda dari nama model)
    protected $table = 'obat'; // Menentukan nama tabel yang digunakan di database, yaitu 'obat'

    // Definisikan kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_obat',  // Nama obat
        'kemasan',    // Kemasan obat
        'harga'       // Harga obat
    ];

    /**
     * Relasi dengan DetailPeriksa (One-to-Many)
     * 
     * Fungsi ini mendefinisikan relasi **One-to-Many** antara model Obat dan model DetailPeriksa.
     * Artinya, satu obat bisa memiliki banyak entri di tabel `detail_periksa`, yang menunjukkan 
     * penggunaan obat tersebut dalam banyak pemeriksaan.
     * Relasi ini diwakili dengan `hasMany()`, yang menunjukkan bahwa satu entri di tabel `obat` 
     * dapat memiliki banyak entri terkait di tabel `detail_periksa`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailPeriksas()
    {
        // Menghubungkan model Obat dengan model DetailPeriksa
        // Menambahkan onDelete('cascade') untuk memastikan bahwa saat obat dihapus, 
        // semua detail periksa yang terkait juga akan dihapus secara otomatis
        return $this->hasMany(DetailPeriksa::class, 'id_obat')->onDelete('cascade');
    }
}
