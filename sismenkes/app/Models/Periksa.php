<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    use HasFactory;

    // Definisikan nama tabel (jika berbeda dari nama model)
    protected $table = 'periksa'; // Nama tabel yang digunakan di database, yaitu 'periksa'

    // Definisikan kolom yang bisa diisi secara massal
    protected $fillable = [
        'id_daftar_poli',  // ID pendaftaran poli terkait pemeriksaan
        'tgl_periksa',     // Tanggal pemeriksaan
        'catatan',         // Catatan pemeriksaan oleh dokter
        'biaya_periksa'    // Biaya pemeriksaan
    ];

    /**
     * Relasi dengan DaftarPoli (Many-to-One)
     * 
     * Fungsi ini mendefinisikan hubungan **Many-to-One** antara model Periksa dan model DaftarPoli.
     * Artinya, setiap pemeriksaan hanya dapat terkait dengan satu pendaftaran poli (setiap entri di `periksa` berhubungan dengan satu entri di `daftar_poli`).
     * Relasi ini diwakili dengan `belongsTo()`, yang menunjukkan bahwa model `Periksa` memiliki kolom `id_daftar_poli` yang merujuk ke model `DaftarPoli`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function daftarPoli()
    {
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli');
    }

    /**
     * Relasi dengan DetailPeriksa (One-to-Many)
     * 
     * Fungsi ini mendefinisikan hubungan **One-to-Many** antara model Periksa dan model DetailPeriksa.
     * Artinya, satu pemeriksaan dapat memiliki banyak detail pemeriksaan yang terkait (misalnya, obat yang diberikan, tindakan lainnya, dll).
     * Relasi ini diwakili dengan `hasMany()`, yang menunjukkan bahwa satu entri di `Periksa` dapat memiliki banyak entri terkait di tabel `detail_periksa`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailPeriksas()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }
}
