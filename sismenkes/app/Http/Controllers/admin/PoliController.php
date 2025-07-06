<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Menampilkan daftar poli yang ada di database.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua data poli dari database
        $polis = Poli::all(); // Ambil semua data poli

        // Mengirim data poli ke view untuk ditampilkan
        return view('admin.poli.index', compact('polis'));
    }

    /**
     * Menampilkan form untuk menambah data poli baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Menampilkan form untuk input data poli baru
        return view('admin.poli.create');
    }

    /**
     * Menyimpan data poli baru yang diterima dari form.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input data yang diterima dari form
        $request->validate([
            'nama_poli' => 'required|string|max:255',     // Nama poli wajib diisi dan berbentuk string
            'keterangan' => 'nullable|string|max:255',    // Keterangan bersifat opsional dan berbentuk string
        ]);

        // Menyimpan data poli baru ke dalam database
        Poli::create($request->all());

        // Setelah berhasil menyimpan data poli, redirect ke halaman daftar poli dengan pesan sukses
        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data poli yang sudah ada.
     *
     * @param \App\Models\Poli $poli
     * @return \Illuminate\View\View
     */
    public function edit(Poli $poli)
    {
        // Menampilkan form untuk mengedit data poli yang sudah ada
        return view('admin.poli.edit', compact('poli'));
    }

    /**
     * Memperbarui data poli yang sudah ada.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Poli $poli
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Poli $poli)
    {
        // Validasi input data yang diterima dari form
        $request->validate([
            'nama_poli' => 'required|string|max:255',     // Nama poli wajib diisi dan berbentuk string
            'keterangan' => 'nullable|string|max:255',    // Keterangan bersifat opsional dan berbentuk string
        ]);

        // Memperbarui data poli yang sudah ada dengan data yang diterima dari form
        $poli->update($request->all());

        // Setelah berhasil memperbarui data, redirect ke halaman daftar poli dengan pesan sukses
        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil diperbarui!');
    }

    /**
     * Menghapus data poli dari database.
     *
     * @param \App\Models\Poli $poli
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Poli $poli)
    {
        // Menghapus data poli dari database
        $poli->delete();

        // Setelah berhasil menghapus data, redirect ke halaman daftar poli dengan pesan sukses
        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil dihapus!');
    }
}
