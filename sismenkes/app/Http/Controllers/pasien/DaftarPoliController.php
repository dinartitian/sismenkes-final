<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Support\Facades\Auth;

class DaftarPoliController extends Controller
{
    /**
     * Menampilkan halaman daftar poli beserta riwayat pendaftaran pasien.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mendapatkan data pasien yang sedang login
        $pasien = Auth::user(); // diasumsikan sudah login sebagai pasien
        
        // Mengambil daftar semua poli yang tersedia
        $poliList = Poli::all();

        // Mengambil riwayat pendaftaran poli berdasarkan ID pasien yang sedang login
        // Dengan relasi untuk mendapatkan jadwal pemeriksaan dan dokter serta poli terkait
        $riwayat = DaftarPoli::with(['jadwalPeriksa.dokter.poli'])
            ->where('id_pasien', $pasien->id)
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu pendaftaran terbaru
            ->get();

        // Mengirimkan data pasien, daftar poli, dan riwayat pendaftaran poli ke tampilan
        return view('pasien.daftar-poli.index', compact('pasien', 'poliList', 'riwayat'));
    }

    /**
     * Menampilkan jadwal yang tersedia berdasarkan poli yang dipilih.
     *
     * @param int $id ID poli yang dipilih
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJadwalByPoli($id)
    {
        // Mengambil jadwal periksa yang terkait dengan poli tertentu
        // Hanya mengambil jadwal yang memiliki status aktif (status = 1)
        $jadwal = JadwalPeriksa::with('dokter') // Mengambil data dokter yang terkait dengan jadwal
            ->whereHas('dokter', function ($query) use ($id) {
                $query->where('id_poli', $id); // Filter jadwal berdasarkan poli yang dipilih
            })
            ->where('status', 1) // Hanya mengambil jadwal yang statusnya aktif
            ->get();

        // Mengembalikan response berupa JSON yang berisi jadwal yang tersedia
        return response()->json($jadwal);
    }

    /**
     * Menyimpan data pendaftaran poli pasien.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input yang diterima dari form pendaftaran
        $request->validate([
            'id_jadwal' => 'required',  // Jadwal pemeriksaan harus dipilih
            'keluhan' => 'required',    // Keluhan pasien harus diisi
        ]);

        // Mendapatkan data pasien yang sedang login
        $pasien = Auth::user();

        // Menghitung jumlah janji yang sudah ada untuk jadwal yang dipilih
        $jumlahJanji = DaftarPoli::where('id_jadwal', $request->id_jadwal)->count();

        // Nomor antrian = jumlah janji yang sudah ada + 1
        $noAntrian = $jumlahJanji + 1;

        // Menyimpan data pendaftaran poli untuk pasien
        DaftarPoli::create([
            'id_pasien' => $pasien->id,   // ID pasien yang sedang login
            'id_jadwal' => $request->id_jadwal,  // ID jadwal yang dipilih
            'keluhan' => $request->keluhan,      // Keluhan pasien
            'no_antrian' => $noAntrian,   // Nomor antrian pasien
        ]);

        // Mengarahkan pasien kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Berhasil daftar poli. Nomor Antrian Anda: ' . $noAntrian);
    }

    /**
     * Menampilkan detail data pendaftaran poli pasien.
     *
     * @param int $id ID pendaftaran poli
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Mencari data pendaftaran poli berdasarkan ID yang diberikan
        $data = DaftarPoli::with(['jadwalPeriksa.dokter', 'jadwalPeriksa.poli']) // Relasi untuk mendapatkan jadwal, dokter, dan poli terkait
            ->findOrFail($id);  // Jika data tidak ditemukan, akan melemparkan 404 error

        // Menampilkan halaman detail pendaftaran poli dengan data pendaftaran yang ditemukan
        return view('pasien.daftar-poli.detail', compact('data'));
    }

    /**
     * Menampilkan riwayat pemeriksaan berdasarkan ID pendaftaran poli.
     *
     * @param int $id ID pendaftaran poli
     * @return \Illuminate\View\View
     */
    public function riwayatPemeriksaan($id)
    {
        // Ambil data pendaftaran poli berdasarkan id pasien dan id pendaftaran poli
        $data = DaftarPoli::with(['periksas', 'jadwalPeriksa.dokter', 'jadwalPeriksa.poli']) // Mengambil data pemeriksaan terkait pendaftaran poli
            ->where('id', $id)
            ->where('id_pasien', Auth::id()) // Memastikan data yang diambil sesuai dengan pasien yang sedang login
            ->firstOrFail(); // Jika tidak ditemukan, akan melemparkan 404 error

        // Mengirim data riwayat pemeriksaan untuk ditampilkan di view
        return view('pasien.daftar-poli.riwayat', compact('data'));
    }
}
