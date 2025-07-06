<?php

use App\Http\Controllers\Auth\DokterLoginController;
use App\Http\Controllers\Auth\PasienLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DokterController;  
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Dokter\DokterProfileController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\MemeriksaController;
use App\Http\Controllers\Dokter\RiwayatController;
use App\Http\Controllers\pasien\DaftarPoliController;
use Illuminate\Support\Facades\Route;

// Route untuk halaman utama (landing page)
Route::get('/', function () {
    return view('welcome');
});

// Route untuk halaman login dokter (login-dokter)
Route::get('login-dokter', [DokterLoginController::class, 'showLoginForm'])->name('dokter.login.form');
Route::post('login-dokter', [DokterLoginController::class, 'login'])->name('dokter.login');

// Route untuk halaman login pasien (login-pasien)
Route::get('login-pasien', [PasienLoginController::class, 'showLoginForm'])->name('pasien.login.form');
Route::post('login-pasien', [PasienLoginController::class, 'login'])->name('pasien.login');

// Route untuk dashboard yang berbeda sesuai dengan role pengguna (Admin, Dokter, Pasien)
// Setiap role memiliki akses ke dashboard masing-masing
Route::middleware(['auth:web'])->get('/admin/dashboard', function () {
    return view('admin.index'); // Dashboard untuk Admin
})->name('admin.dashboard');

Route::middleware(['auth:dokter'])->get('/dokter/dashboard', function () {
    return view('dokter.index'); // Dashboard untuk Dokter
})->name('dokter.dashboard');

Route::middleware(['auth:pasien'])->get('/pasien/dashboard', function () {
    return view('pasien.index'); // Dashboard untuk Pasien
})->name('pasien.dashboard');

// ====================================================
// Route untuk Admin (Manajemen Dokter, Pasien, Poli, dan Obat)
// ====================================================

Route::prefix('admin')->middleware(['auth:web', \App\Http\Middleware\IsAdmin::class])->group(function () {
    
    // CRUD untuk Dokter, hanya untuk Admin
    Route::resource('dokter', DokterController::class)->names('admin.dokter');

    // CRUD untuk Pasien, hanya untuk Admin
    Route::resource('pasien', PasienController::class)->names('admin.pasien');

    // CRUD untuk Poli, hanya untuk Admin
    Route::resource('poli', PoliController::class)->names('admin.poli');

    // CRUD untuk Obat, hanya untuk Admin
    Route::resource('obat', ObatController::class)->names('admin.obat');
});

// ====================================================
// Route untuk Dokter (Aksi: Profil, Jadwal, Pemeriksaan Medis)
// ====================================================

Route::middleware('auth:dokter')->prefix('dokter')->name('dokter.')->group(function () {
    
    // Route untuk mengelola Profil Dokter
    Route::get('profile/edit', [DokterProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/update', [DokterProfileController::class, 'update'])->name('profile.update');
    
    // Route untuk mengelola Jadwal Pemeriksaan oleh Dokter
    Route::get('jadwal', [JadwalPeriksaController::class, 'index'])->name('jadwal.index');
    Route::get('jadwal/create', [JadwalPeriksaController::class, 'create'])->name('jadwal.create');
    Route::post('jadwal', [JadwalPeriksaController::class, 'store'])->name('jadwal.store');
    Route::put('jadwal/{id}/toggle-status', [JadwalPeriksaController::class, 'toggleStatus'])->name('jadwal.toggleStatus');
    Route::delete('jadwal/{id}', [JadwalPeriksaController::class, 'destroy'])->name('jadwal.destroy');
    
    // Route untuk Pemeriksaan Medis oleh Dokter
    Route::get('memeriksa', [MemeriksaController::class, 'index'])->name('memeriksa.index');
    Route::get('memeriksa/{id}', [MemeriksaController::class, 'show'])->name('memeriksa.show');
    Route::post('memeriksa/store', [MemeriksaController::class, 'store'])->name('memeriksa.store');
    Route::get('memeriksa/{id}/edit', [MemeriksaController::class, 'edit'])->name('memeriksa.edit');
    Route::put('memeriksa/{id}', [MemeriksaController::class, 'update'])->name('memeriksa.update');
    
    // Route untuk melihat Riwayat Pemeriksaan oleh Dokter
    Route::get('riwayat-periksa', [RiwayatController::class, 'index'])->name('riwayat-periksa.index');
    Route::get('riwayat-periksa/{id}', [RiwayatController::class, 'show'])->name('riwayat-periksa.show');
});

// ====================================================
// Route untuk Pasien (Aksi: Daftar Poli, Riwayat Pemeriksaan)
// ====================================================

Route::middleware(['auth:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    
    // Route untuk mendaftar ke Poli (departemen medis)
    Route::get('daftar-poli', [DaftarPoliController::class, 'index'])->name('daftar-poli.index');
    Route::get('daftar-poli/create', [DaftarPoliController::class, 'create'])->name('daftar-poli.create');
    Route::post('daftar-poli', [DaftarPoliController::class, 'store'])->name('daftar-poli.store');
    Route::get('jadwal-by-poli/{id}', [DaftarPoliController::class, 'getJadwalByPoli'])->name('daftar-poli.jadwal-by-poli');
    Route::get('daftar-poli/{id}/detail', [DaftarPoliController::class, 'show'])->name('daftar-poli.detail');
    
    // Route untuk melihat Riwayat Pemeriksaan Pasien
    Route::get('riwayat-pemeriksaan/{id}', [DaftarPoliController::class, 'riwayatPemeriksaan'])->name('riwayat-pemeriksaan');
});

// ====================================================
// Route untuk Manajemen Profil (Semua Role: Admin, Dokter, Pasien)
// ====================================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Laravel Auth routes (untuk login dan register)
require __DIR__.'/auth.php';
