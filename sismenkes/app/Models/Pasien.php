<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pasien extends Authenticatable
{
    use Notifiable;

    // Menentukan nama tabel yang digunakan oleh model ini (jika berbeda dari nama model)
    protected $table = 'pasien'; // Nama tabel di database yang berisi data pasien

    // Menentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama',  // Nama pasien
        'alamat', // Alamat pasien
        'no_ktp', // Nomor KTP pasien
        'no_hp', // Nomor telepon pasien
        'no_rm'  // Nomor rekam medis pasien
    ];

    // Menentukan kolom yang tidak boleh diisi secara massal (kosong berarti semua kolom dapat diisi)
    protected $guarded = [];

    /**
     * Boot method untuk generate no_rm otomatis.
     * 
     * Fungsi ini akan dipanggil setiap kali model Pasien dibuat (misalnya saat menyimpan pasien baru).
     * Jika `no_rm` belum diisi, maka akan dihasilkan nomor rekam medis otomatis berdasarkan 
     * urutan nomor pasien sebelumnya. Format nomor rekam medis adalah YYYYMM-XXX, 
     * di mana XXX adalah nomor urut pasien pada bulan dan tahun tertentu.
     */
    protected static function boot()
    {
        // Memanggil method boot dari parent (Authenticatable)
        parent::boot();

        // Hook ke event 'creating' untuk generate no_rm sebelum data disimpan
        static::creating(function ($pasien) {
            if (!$pasien->no_rm) {
                // Ambil pasien terakhir berdasarkan urutan
                $latest = self::latest()->first(); // Mengambil pasien terakhir berdasarkan urutan

                // Set nomor urut default jika belum ada pasien sebelumnya
                $noUrut = 1;

                // Jika ada pasien sebelumnya, ambil nomor urut terakhir dan increment
                if ($latest) {
                    $lastNoRm = $latest->no_rm; // Ambil no_rm pasien terakhir
                    $lastNumber = (int) substr($lastNoRm, -3); // Ambil 3 digit terakhir dari no_rm
                    $noUrut = $lastNumber + 1; // Increment nomor urut
                }

                // Format no_rm menjadi YYYMM-XXX (misalnya: 202506-003)
                $pasien->no_rm = date('Ym') . '-' . str_pad($noUrut, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
