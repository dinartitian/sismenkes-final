<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Menampilkan daftar pasien yang ada di database.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua data pasien dari database
        $pasien = Pasien::all();

        // Mengirim data pasien ke view untuk ditampilkan
        return view('admin.pasien.index', compact('pasien'));
    }

    /**
     * Menampilkan form untuk menambah data pasien baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Menampilkan form untuk input data pasien baru
        return view('admin.pasien.create');
    }

    /**
     * Menyimpan data pasien baru yang diterima dari form.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input data yang diterima dari form
        $request->validate([
            'nama' => 'required|string|max:255',     // Nama pasien wajib diisi dan berbentuk string
            'alamat' => 'required|string|max:255',   // Alamat pasien wajib diisi dan berbentuk string
            'no_ktp' => 'required|string|max:20',    // Nomor KTP pasien wajib diisi dan berbentuk string
            'no_hp' => 'required|string|max:15',     // Nomor HP pasien wajib diisi dan berbentuk string
        ]);

        // Menyimpan data pasien baru ke dalam database
        Pasien::create($request->all());

        // Setelah berhasil menyimpan data pasien, redirect ke halaman daftar pasien dengan pesan sukses
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data pasien yang sudah ada.
     *
     * @param \App\Models\Pasien $pasien
     * @return \Illuminate\View\View
     */
    public function edit(Pasien $pasien)
    {
        // Menampilkan form untuk mengedit data pasien yang sudah ada
        return view('admin.pasien.edit', compact('pasien'));
    }

    /**
     * Memperbarui data pasien yang sudah ada.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pasien $pasien
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Pasien $pasien)
    {
        // Validasi input data yang diterima dari form
        $request->validate([
            'nama' => 'required|string|max:255',     // Nama pasien wajib diisi dan berbentuk string
            'alamat' => 'required|string|max:255',   // Alamat pasien wajib diisi dan berbentuk string
            'no_ktp' => 'required|string|max:20',    // Nomor KTP pasien wajib diisi dan berbentuk string
            'no_hp' => 'required|string|max:15',     // Nomor HP pasien wajib diisi dan berbentuk string
        ]);

        // Memperbarui data pasien yang sudah ada
        $pasien->update($request->all());

        // Setelah berhasil memperbarui data, redirect ke halaman daftar pasien dengan pesan sukses
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil diperbarui!');
    }

    /**
     * Menghapus data pasien dari database.
     *
     * @param \App\Models\Pasien $pasien
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pasien $pasien)
    {
        // Menghapus data pasien dari database
        $pasien->delete();

        // Setelah berhasil menghapus data, redirect ke halaman daftar pasien dengan pesan sukses
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil dihapus!');
    }
}
