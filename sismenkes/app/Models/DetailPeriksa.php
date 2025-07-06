<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
    use HasFactory;

    // Definisikan nama tabel (jika berbeda dari nama model)
    protected $table = 'detail_periksa'; // Nama tabel yang digunakan di database, yaitu 'detail_periksa'

    // Definisikan kolom yang bisa diisi secara massal
    protected $fillable = [
        'id_periksa', // ID pemeriksaan yang terkait dengan detail periksa
        'id_obat'    // ID obat yang diberikan pada detail periksa
    ];

    // Relasi dengan Periksa (Many-to-One)
    public function periksa()
    {
        // Relasi Many-to-One antara DetailPeriksa dan Periksa
        // Setiap detail periksa terkait dengan satu pemeriksaan
        return $this->belongsTo(Periksa::class, 'id_periksa');
    }

    // Relasi dengan Obat (Many-to-One)
    public function obat()
    {
        // Relasi Many-to-One antara DetailPeriksa dan Obat
        // Setiap detail periksa terkait dengan satu obat yang diberikan
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
