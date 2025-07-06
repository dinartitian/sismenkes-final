<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard yang sesuai berdasarkan role pengguna (Admin, Dokter, Pasien).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengecek apakah pengguna sudah login
        if (Auth::check()) {
            // Jika pengguna adalah Admin, arahkan ke dashboard admin
            if (Auth::user() instanceof \App\Models\User) {
                return redirect()->route('admin.index');  // Redirect ke dashboard admin
            }

            // Jika pengguna adalah Dokter, arahkan ke dashboard dokter
            if (Auth::user() instanceof \App\Models\Dokter) {
                return redirect()->route('dokter.index');  // Redirect ke dashboard dokter
            }

            // Jika pengguna adalah Pasien, arahkan ke dashboard pasien
            if (Auth::user() instanceof \App\Models\Pasien) {
                return redirect()->route('pasien.index');  // Redirect ke dashboard pasien
            }
        }

        // Jika tidak ada pengguna yang login, arahkan ke halaman login
        return redirect()->route('login');
    }
}
