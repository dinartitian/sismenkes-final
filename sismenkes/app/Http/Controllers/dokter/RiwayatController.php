<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;   // Model Pasien
use App\Models\Periksa; // Model Pemeriksaan
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    /**
     * Menampilkan daftar riwayat pemeriksaan untuk semua pasien.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua data pasien tanpa filter berdasarkan role
        $pasien = User::all(); // Mengambil semua pasien, pastikan tidak ada filter berdasarkan 'role'

        /** @var \App\Models\Dokter $dokter */
        // Mendapatkan dokter yang sedang login
        $dokter = Auth::guard('dokter')->user();

        // Mengambil semua pasien, bisa dengan role 'pasien'
        $pasien = Pasien::get(); // Mengambil semua pasien yang terdaftar

        // Menampilkan halaman daftar riwayat pemeriksaan pasien
        return view('dokter.riwayat-periksa.index', compact('pasien')); // Mengirim data pasien ke view
    }

    /**
     * Menampilkan riwayat pemeriksaan berdasarkan ID pasien.
     *
     * @param int $id ID pasien
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Mencari pasien berdasarkan ID yang diberikan
        $pasien = Pasien::findOrFail($id);  // Jika pasien tidak ditemukan, akan melemparkan 404 error

        // Mengambil riwayat pemeriksaan berdasarkan ID pasien
        $riwayat = Periksa::whereHas('daftarPoli', function ($query) use ($id) {
            // Mengambil riwayat pemeriksaan yang terkait dengan pasien berdasarkan id
            $query->where('id_pasien', $id);  // Filter berdasarkan ID pasien
        })
        ->get();  // Mendapatkan semua riwayat pemeriksaan pasien tersebut

        // Mengirimkan data pasien dan riwayat pemeriksaan ke view 'dokter.riwayat.show'
        return view('dokter.riwayat-periksa.show', compact('pasien', 'riwayat'));  // Mengirim data ke view
    }
}
