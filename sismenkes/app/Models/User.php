<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable; // Menggunakan trait HasFactory untuk factory dan Notifiable untuk pengiriman notifikasi

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    
    protected $fillable = [
        'name',     // Nama pengguna
        'email',    // Email pengguna
        'password', // Password pengguna
    ];

    // Menentukan guard yang digunakan untuk autentikasi pengguna
    protected $guard = 'admin'; // Pengguna ini diatur untuk menggunakan guard 'admin', yang berarti autentikasi pengguna dengan role admin

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',      // Menyembunyikan password agar tidak muncul ketika model diserialisasi
        'remember_token',// Menyembunyikan token 'remember me' saat serialisasi
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Menyatakan bahwa kolom 'email_verified_at' harus diperlakukan sebagai tipe datetime
            'password' => 'hashed', // Menyatakan bahwa kolom 'password' harus diperlakukan sebagai hashed string
        ];
    }
}
