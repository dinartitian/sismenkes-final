<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemeriksaController extends Controller
{
    /**
     * Menampilkan halaman daftar pasien yang ingin diperiksa oleh dokter.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /** @var \App\Models\Dokter $dokter */
        // Mendapatkan data dokter yang sedang login
        $dokter = Auth::guard('dokter')->user();

        // Mendapatkan jadwal aktif (status = 1) yang dimiliki oleh dokter
        $jadwal = $dokter->jadwals()->where('status', 1)->first();

        // Jika jadwal aktif ditemukan, ambil daftar pasien yang terdaftar untuk pemeriksaan
        if ($jadwal) {
            $daftarPoli = DaftarPoli::where('id_jadwal', $jadwal->id)->get();
            return view('dokter.memeriksa.index', compact('daftarPoli'));
        }

        // Jika tidak ada jadwal aktif, tampilkan error
        return redirect()->back()->with('error', 'Jadwal periksa tidak ditemukan.');
    }

    /**
     * Menampilkan halaman untuk memeriksa pasien tertentu.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Mencari pasien berdasarkan ID yang ingin diperiksa
        $daftarPoli = DaftarPoli::findOrFail($id);
        
        // Mendapatkan semua obat yang tersedia untuk diberikan ke pasien
        $obats = Obat::all();
        
        // Menampilkan halaman pemeriksaan pasien dengan data obat yang tersedia
        return view('dokter.memeriksa.show', compact('daftarPoli', 'obats'));
    }

    /**
     * Menyimpan data pemeriksaan pasien.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input yang diterima dari form pemeriksaan
        $request->validate([
            'tgl_periksa' => 'required|date',           // Tanggal pemeriksaan harus diisi dan berupa tanggal
            'catatan' => 'nullable|string',             // Catatan bersifat opsional dan harus berupa string
            'obat' => 'required|array',                 // Obat yang diberikan harus berupa array
            'obat.*' => 'exists:obat,id',                // Validasi setiap obat yang dipilih harus ada di tabel obat
        ]);

        // Biaya pemeriksaan tetap
        $biayaPeriksa = 150000;

        // Simpan data pemeriksaan ke dalam tabel Periksa
        $periksa = Periksa::create([
            'id_daftar_poli' => $request->id_daftar_poli,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $biayaPeriksa,  // Biaya pemeriksaan tetap
        ]);

        // Menyimpan detail obat yang diberikan kepada pasien
        $totalObat = 0;
        foreach ($request->obat as $obatId) {
            // Ambil harga obat dan tambahkan ke total biaya obat
            $obat = Obat::find($obatId);
            $totalObat += $obat->harga;  // Tambahkan harga obat
            $periksa->detailPeriksas()->create([
                'id_obat' => $obatId,
            ]);
        }

        // Hitung total pembayaran untuk pemeriksaan
        $totalPembayaran = $biayaPeriksa + $totalObat;

        // Update total biaya pemeriksaan dengan biaya obat yang telah dihitung
        $periksa->update(['biaya_periksa' => $totalPembayaran]);

        // Redirect setelah berhasil menyimpan data pemeriksaan
        return redirect()->route('dokter.memeriksa.index')->with('success', 'Pemeriksaan berhasil disimpan.');
    }

    /**
     * Menampilkan halaman untuk mengedit data pemeriksaan.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Mencari data pemeriksaan berdasarkan ID
        $periksa = Periksa::findOrFail($id);

        // Mendapatkan semua obat yang tersedia untuk dipilih
        $obats = Obat::all();

        // Menampilkan halaman edit pemeriksaan dengan data pemeriksaan dan obat yang tersedia
        return view('dokter.memeriksa.edit', compact('periksa', 'obats'));
    }
    
    /**
     * Memperbarui data pemeriksaan pasien.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi input yang diterima dari form pemeriksaan
        $request->validate([
            'tgl_periksa' => 'required|date',   // Tanggal pemeriksaan harus diisi dan berupa tanggal
            'catatan' => 'nullable|string',     // Catatan bersifat opsional dan berupa string
            'obat' => 'required|array',         // Obat yang diberikan harus berupa array
            'obat.*' => 'exists:obat,id',        // Validasi setiap obat yang dipilih harus ada di tabel obat
        ]);

        // Mencari pemeriksaan berdasarkan ID
        $periksa = Periksa::findOrFail($id);
        $periksa->tgl_periksa = $request->tgl_periksa;
        $periksa->catatan = $request->catatan;
        $periksa->biaya_periksa = 150000;  // Biaya pemeriksaan tetap
        $periksa->save();  // Simpan perubahan pada data pemeriksaan

        // Hapus obat sebelumnya yang terdaftar di pemeriksaan dan simpan obat yang baru
        $periksa->detailPeriksas()->delete();

        foreach ($request->obat as $obatId) {
            $periksa->detailPeriksas()->create([
                'id_obat' => $obatId,  // Simpan obat yang diberikan pada pemeriksaan
            ]);
        }

        // Redirect ke halaman daftar pemeriksaan dengan pesan sukses
        return redirect()->route('dokter.memeriksa.index')->with('success', 'Pemeriksaan berhasil diperbarui!');
    }
}
