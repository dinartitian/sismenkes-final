<?php

namespace App\Http\Controllers\Auth;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DokterLoginController extends Controller
{
    /**
     * Menampilkan halaman login untuk dokter.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Menampilkan form login untuk dokter
        return view('auth.dokter-login');
    }

    /**
     * Menangani proses login untuk dokter.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validasi input dari form login
        $request->validate([
            'nama' => 'required|string',  // Nama dokter harus diisi dan berbentuk string
            'alamat' => 'required|string', // Alamat dokter harus diisi dan berbentuk string
        ]);

        // Mencari dokter berdasarkan nama dan alamat yang dimasukkan
        $dokter = Dokter::where('nama', $request->nama)
                        ->where('alamat', $request->alamat)
                        ->first(); // Mengambil data dokter pertama yang ditemukan berdasarkan kondisi

        // Jika dokter ditemukan
        if ($dokter) {
            // Melakukan login menggunakan guard 'dokter' dan mengarahkan ke dashboard dokter
            Auth::guard('dokter')->login($dokter);
            return redirect()->route('dokter.dashboard');  // Mengarahkan ke halaman dashboard dokter
        }

        // Jika dokter tidak ditemukan, tampilkan pesan error dan tetap di halaman login
        return back()->withInput()->withErrors([
            'message' => 'Nama dan alamat tidak cocok dengan data dokter.' // Pesan error jika data tidak cocok
        ]);
    }

    /**
     * Logout dokter dari aplikasi.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Logout dokter menggunakan guard 'dokter'
        Auth::guard('dokter')->logout();

        // Mengarahkan dokter kembali ke halaman login dokter
        return redirect('/login-dokter');
    }
}
