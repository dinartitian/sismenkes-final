<?php

return [

    /*
    |---------------------------------------------------------------------- 
    | Authentication Defaults 
    |---------------------------------------------------------------------- 
    */
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        // 'guard' mendefinisikan guard default yang digunakan untuk autentikasi. 
        // Di sini, 'web' digunakan sebagai default, yang berarti aplikasi menggunakan session guard untuk autentikasi web.

        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
        // 'passwords' mendefinisikan password broker default yang digunakan untuk reset password.
        // Defaultnya adalah 'users', artinya akan menggunakan provider 'users' untuk reset password.
    ],

    /*
    |---------------------------------------------------------------------- 
    | Authentication Guards 
    |---------------------------------------------------------------------- 
    */
   'guards' => [
        'admin' => [
            'driver' => 'session',
            // 'driver' yang digunakan untuk guard 'admin' adalah 'session', yang berarti menggunakan session untuk manajemen autentikasi.
            'provider' => 'admin',
            // 'provider' mendefinisikan model dan sumber data untuk guard ini. 'users' berarti menggunakan provider 'users' yang ada di bagian 'providers'.
        ],
        'dokter' => [
            'driver' => 'session',
            // 'driver' yang digunakan untuk guard 'dokter' juga 'session', sama seperti 'admin'.
            'provider' => 'dokters',
            // 'provider' mendefinisikan model dan sumber data untuk guard ini. 'dokters' berarti menggunakan provider yang ada di bagian 'providers' untuk dokter.
        ],
        'pasien' => [
            'driver' => 'session',
            // 'driver' untuk guard 'pasien' adalah 'session', memungkinkan autentikasi berbasis sesi.
            'provider' => 'pasiens',
            // 'provider' mendefinisikan model dan sumber data untuk guard ini. 'pasiens' berarti menggunakan provider untuk pasien.
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | User Providers
    |----------------------------------------------------------------------
    */
    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            // 'driver' untuk 'admin' menggunakan Eloquent ORM untuk mengakses data pengguna.
            'model' => App\Models\User::class,
            // 'model' mendefinisikan model yang digunakan untuk autentikasi user, yaitu model 'User' di App\Models.
        ],
        'dokters' => [
            'driver' => 'eloquent',
            // 'driver' untuk 'dokters' menggunakan Eloquent ORM untuk mengakses data dokter.
            'model' => App\Models\Dokter::class,
            // 'model' mendefinisikan model yang digunakan untuk autentikasi dokter, yaitu model 'Dokter' di App\Models.
        ],
        'pasiens' => [
            'driver' => 'eloquent',
            // 'driver' untuk 'pasiens' menggunakan Eloquent ORM untuk mengakses data pasien.
            'model' => App\Models\Pasien::class, 
            // 'model' mendefinisikan model yang digunakan untuk autentikasi pasien, yaitu model 'Pasien' di App\Models.
        ],
    ],

    /*
    |---------------------------------------------------------------------- 
    | Passwords Configuration 
    |---------------------------------------------------------------------- 
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            // 'provider' untuk reset password adalah 'users', yang sesuai dengan provider di bagian 'providers'.
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            // 'table' mendefinisikan tabel database untuk menyimpan token reset password, defaultnya 'password_reset_tokens'.
            'expire' => 60,
            // 'expire' menentukan waktu kedaluwarsa token reset password dalam menit. Di sini, token akan kedaluwarsa dalam 60 menit.
            'throttle' => 60,
            // 'throttle' adalah pengaturan pembatasan berapa kali permintaan reset password bisa dilakukan dalam waktu tertentu (60 detik).
        ],
    ],

    /*
    |---------------------------------------------------------------------- 
    | Password Confirmation Timeout 
    |---------------------------------------------------------------------- 
    */
    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
    // 'password_timeout' mendefinisikan waktu tunggu dalam detik untuk konfirmasi password saat reset. Defaultnya 10800 detik (3 jam).
];
