<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Periksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    /**
     * Menampilkan daftar dokter dengan pagination dan relasi dengan poli.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dokters = Dokter::with('poli')->paginate(10); // Menambahkan pagination
        return view('admin.dokter.index', compact('dokters'));
    }

    /**
     * Menampilkan form untuk membuat dokter baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $polis = Poli::all(); // Mengambil semua data poli untuk dipilih oleh admin
        return view('admin.dokter.create', compact('polis'));
    }

    /**
     * Menyimpan data dokter baru ke dalam database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input data dari form
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|exists:poli,id',
        ]);

        try {
            DB::beginTransaction(); // Mulai transaksi database
            
            // Menyimpan data dokter baru
            Dokter::create($validated);

            DB::commit(); // Commit transaksi jika berhasil

            // Menampilkan pesan sukses
            session()->flash('success', 'Data dokter berhasil ditambahkan');
            return redirect()->route('admin.dokter.index');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error
            session()->flash('error', 'Gagal menambahkan data dokter');
            return back()->withInput(); // Mengembalikan input yang salah
        }
    }

    /**
     * Menampilkan form untuk mengedit data dokter yang sudah ada.
     *
     * @param \App\Models\Dokter $dokter
     * @return \Illuminate\View\View
     */
    public function edit(Dokter $dokter)
    {
        $polis = Poli::all(); // Mengambil semua data poli
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    /**
     * Memperbarui data dokter yang sudah ada.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dokter $dokter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Dokter $dokter)
    {
        // Validasi input data untuk update
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|exists:poli,id',
        ]);

        try {
            DB::beginTransaction(); // Mulai transaksi database
            
            // Memperbarui data dokter
            $dokter->update($validated);

            DB::commit(); // Commit transaksi jika berhasil

            // Menampilkan pesan sukses
            session()->flash('success', 'Data dokter berhasil diperbarui');
            return redirect()->route('admin.dokter.index');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error
            session()->flash('error', 'Gagal memperbarui data dokter');
            return back()->withInput(); // Mengembalikan input yang salah
        }
    }

    /**
     * Menghapus data dokter dari database tanpa memeriksa relasi terkait.
     *
     * @param \App\Models\Dokter $dokter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Dokter $dokter)
    {
        // Menghapus dokter
        $dokter->delete();

        // Menampilkan pesan sukses
        session()->flash('success', 'Data dokter berhasil dihapus');
        return redirect()->route('admin.dokter.index');
    }

    /**
     * Menghapus data dokter beserta data terkait yang berelasi (jadwal, daftar poli, periksa, detail periksa).
     *
     * @param \App\Models\Dokter $dokter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy_(Dokter $dokter)
    {
        try {
            DB::beginTransaction(); // Mulai transaksi database

            // 1. Mengambil semua jadwal periksa yang terkait dengan dokter
            $jadwals = $dokter->jadwals;  // Mengambil semua jadwal yang terkait dengan dokter ini

            // 2. Hapus data terkait di tabel periksa yang terkait dengan daftar_poli (berelasi dengan jadwal)
            foreach ($jadwals as $jadwal) {
                // Menghapus data periksa yang terkait dengan daftar_poli yang terkait dengan jadwal
                $jadwal->periksas->each(function ($periksa) {
                    // Menghapus data yang terkait di tabel detail_periksa
                    $periksa->detailPeriksas()->delete();  // Menghapus detail_periksa yang terkait dengan periksa
                });

                // Menghapus data periksa
                $jadwal->periksas()->delete();

                // Menghapus daftar_poli yang terkait dengan jadwal
                $jadwal->daftarPolis()->delete();
            }

            // 3. Hapus jadwal periksa yang terkait dengan dokter
            $dokter->jadwals()->delete();

            // 4. Hapus dokter
            $dokter->delete();

            DB::commit(); // Commit transaksi jika berhasil

            // Menampilkan pesan sukses
            session()->flash('success', 'Data dokter berhasil dihapus');
            return redirect()->route('admin.dokter.index');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error
            session()->flash('error', 'Gagal menghapus data dokter. Error: ' . $e->getMessage());
            return back(); // Mengembalikan ke halaman sebelumnya
        }
    }
}
