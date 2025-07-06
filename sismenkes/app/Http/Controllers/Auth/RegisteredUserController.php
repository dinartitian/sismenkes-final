<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pasien;  
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman registrasi untuk pasien.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        // Menampilkan form registrasi untuk pasien
        return view('auth.register');
    }

    /**
     * Menangani permintaan registrasi pasien yang masuk.
     *
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input yang diterima dari form registrasi
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],  // Nama pasien harus diisi dan berbentuk string
            'no_ktp' => ['required', 'numeric', 'digits_between:10,25'],  // Validasi No KTP, harus angka dan panjang antara 10 sampai 25 digit
            'no_hp' => ['required', 'numeric', 'digits_between:10,15'],  // Validasi No HP, harus angka dan panjang antara 10 sampai 15 digit
            'alamat' => ['required', 'string', 'max:255'],  // Alamat pasien harus diisi dan berbentuk string
        ]);

        // Mendapatkan nomor rekam medis terakhir dan menambahkan satu untuk menghasilkan nomor RM baru
        $latestNoRm = Pasien::latest()->first();  // Mengambil data pasien terakhir dari database
        $latestNoRm = $latestNoRm ? (int) substr($latestNoRm->no_rm, -3) : 0;  // Ekstrak 3 digit terakhir dari nomor RM terakhir atau set 0 jika tidak ada
        $noRm = date('Ym') . '-' . str_pad($latestNoRm + 1, 3, '0', STR_PAD_LEFT);  // Generate nomor RM baru berdasarkan format YYYYMM-xxx

        // Menyimpan data pasien yang baru dengan nomor rekam medis yang dihasilkan
        $pasien = Pasien::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'no_rm' => $noRm,  // Menyimpan nomor RM yang telah di-generate
        ]);

        // Setelah pasien berhasil didaftarkan, mengarahkan mereka ke halaman login pasien
        return redirect('/login-pasien')->with('success', 'Pasien berhasil didaftar');  // Redirect ke halaman login dengan pesan sukses
    }
}
