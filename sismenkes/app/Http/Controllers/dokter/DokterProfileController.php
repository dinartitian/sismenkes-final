<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DokterProfileController extends Controller
{
    /**
     * Menampilkan halaman untuk mengedit profile dokter.
     */
    public function edit()
    {
        // Mendapatkan data dokter yang sedang login menggunakan guard 'dokter'
        $dokter = Auth::guard('dokter')->user();
        
        // Mengambil semua data poli yang ada
        $polis = Poli::all();
        
        // Mengirim data dokter dan daftar poli ke view untuk ditampilkan
        return view('dokter.profile.edit', compact('dokter', 'polis'));
    }

    /**
     * Menyimpan perubahan data profile dokter yang sudah dilakukan.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Mendapatkan data dokter yang sedang login
        /** @var \App\Models\Dokter $dokter */
        $dokter = Auth::guard('dokter')->user();

        // Validasi input yang diterima dari form
        $request->validate([
            'nama'    => 'required|string|max:255',     // Nama dokter harus diisi dan berbentuk string
            'alamat'  => 'required|string|max:255',     // Alamat dokter harus diisi dan berbentuk string
            'no_hp'   => 'required|string|max:15',      // Nomor HP dokter harus diisi dan berbentuk string
            'id_poli' => 'required|exists:poli,id',     // Poli yang dipilih harus valid dan ada di tabel poli
        ]);

        // Menyimpan perubahan data dokter yang ada
        $dokter->update([
            'nama'    => $request->nama,    // Memperbarui nama dokter
            'alamat'  => $request->alamat,  // Memperbarui alamat dokter
            'no_hp'   => $request->no_hp,   // Memperbarui nomor HP dokter
            'id_poli' => $request->id_poli, // Memperbarui ID poli yang dipilih dokter
        ]);

        // Setelah berhasil memperbarui, mengarahkan kembali ke halaman edit profile dengan pesan sukses
        return redirect()->route('dokter.profile.edit')->with('success', 'Profile berhasil diperbarui.');
    }
}
