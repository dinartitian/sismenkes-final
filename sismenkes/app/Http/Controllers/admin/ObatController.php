<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Menampilkan daftar obat yang ada di database.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua data obat dari database
        $obats = Obat::all();

        // Menampilkan view yang berisi daftar obat
        return view('admin.obat.index', compact('obats'));
    }

    /**
     * Menampilkan form untuk membuat obat baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Menampilkan form untuk menambahkan obat baru
        return view('admin.obat.create');
    }

    /**
     * Menyimpan data obat baru ke dalam database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi inputan yang diterima dari form
        $request->validate([
            'nama_obat' => 'required|string|max:255',  // Nama obat harus diisi dan berbentuk string
            'kemasan' => 'required|string|max:255',    // Kemasan obat harus diisi dan berbentuk string
            'harga' => 'required|numeric',             // Harga obat harus diisi dan berbentuk angka
        ]);

        // Menyimpan data obat yang sudah divalidasi ke dalam database
        Obat::create($request->all());

        // Setelah berhasil menyimpan, redirect kembali ke halaman daftar obat dengan pesan sukses
        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data obat yang sudah ada.
     *
     * @param \App\Models\Obat $obat
     * @return \Illuminate\View\View
     */
    public function edit(Obat $obat)
    {
        // Menampilkan form edit dengan membawa data obat yang ingin diubah
        return view('admin.obat.edit', compact('obat'));
    }

    /**
     * Memperbarui data obat yang sudah ada.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Obat $obat
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Obat $obat)
    {
        // Validasi inputan yang diterima dari form
        $request->validate([
            'nama_obat' => 'required|string|max:255',  // Nama obat harus diisi dan berbentuk string
            'kemasan' => 'required|string|max:255',    // Kemasan obat harus diisi dan berbentuk string
            'harga' => 'required|numeric',             // Harga obat harus diisi dan berbentuk angka
        ]);

        // Memperbarui data obat yang sudah ada dengan data yang diterima dari form
        $obat->update($request->all());

        // Setelah berhasil memperbarui, redirect kembali ke halaman daftar obat dengan pesan sukses
        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil diperbarui.');
    }

    /**
     * Menghapus data obat dari database.
     * Tidak akan menghapus obat jika obat tersebut masih digunakan di detail pemeriksaan.
     *
     * @param \App\Models\Obat $obat
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Obat $obat)
    {
        // Mengecek apakah obat masih digunakan dalam detail pemeriksaan (detail_periksa)
        if(DetailPeriksa::where('id_obat', $obat->id)->exists()) {
            // Jika obat masih digunakan dalam pemeriksaan, tampilkan pesan error dan jangan hapus obat
            return redirect()->route('admin.obat.index')->with('error', 'Obat tidak dapat dihapus karena masih digunakan di detail periksa.');
        }

        // Jika obat tidak digunakan, hapus data obat dari database
        $obat->delete();

        // Setelah berhasil menghapus, redirect kembali ke halaman daftar obat dengan pesan sukses
        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
