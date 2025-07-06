<?php

namespace App\Http\Controllers\Auth;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PasienLoginController extends Controller
{
    /**
     * Menampilkan halaman login untuk pasien.
     */
    public function showLoginForm()
    {
        // Mengecek apakah pasien sudah login
        if (Auth::guard('pasien')->check()) {
            // Jika sudah login, arahkan langsung ke dashboard pasien
            return redirect()->route('pasien.dashboard');
        }

        // Jika belum login, tampilkan halaman login pasien
        return view('auth.pasien-login');
    }

    /**
     * Menangani proses login untuk pasien.
     */
    public function login(Request $request)
    {
        // Validasi input data dari form login
        $request->validate([
            'nama' => 'required|string',  // Nama pasien wajib diisi dan berbentuk string
            'alamat' => 'required|string', // Alamat pasien wajib diisi dan berbentuk string
        ]);

        // Mencari pasien berdasarkan nama dan alamat
        $pasien = Pasien::where('nama', $request->nama)
                        ->where('alamat', $request->alamat)
                        ->first(); // Mengambil data pasien pertama yang ditemukan

        // Jika pasien ditemukan, lakukan login
        if ($pasien) {
            // Melakukan login menggunakan guard 'pasien'
            Auth::guard('pasien')->login($pasien);

            // Arahkan ke halaman dashboard pasien
            return redirect()->intended(route('pasien.dashboard'));
        }

        // Jika kredensial tidak valid, tampilkan pesan error dan kembali ke halaman login
        return back()->withInput()->withErrors([
            'message' => 'Kredensial tidak valid' // Pesan error jika nama dan alamat tidak cocok
        ]);
    }

    /**
     * Logout pasien dari aplikasi.
     */
    public function logout()
    {
        // Logout pasien menggunakan guard 'pasien'
        Auth::guard('pasien')->logout();

        // Arahkan pasien kembali ke halaman login
        return redirect()->route('pasien.login');
    }
}
