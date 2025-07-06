<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;

class JadwalPeriksaController extends Controller
{
    /**
     * Menampilkan daftar jadwal periksa yang dimiliki oleh dokter yang sedang login.
     */
    public function index()
    {
        // Mengambil semua jadwal yang dimiliki oleh dokter yang sedang login
        $jadwals = JadwalPeriksa::where('id_dokter', Auth::guard('dokter')->id())->get(); // Mengambil jadwal berdasarkan id dokter yang sedang login

        // Mengirim data jadwal ke halaman daftar jadwal untuk ditampilkan
        return view('dokter.jadwal.index', compact('jadwals'));
    }

    /**
     * Menampilkan form untuk membuat jadwal periksa baru.
     */
    public function create()
    {
        // Menampilkan halaman form untuk membuat jadwal periksa baru
        return view('dokter.jadwal.create'); // Pastikan file create.blade.php ada di folder dokters/jadwal
    }

    /**
     * Menyimpan jadwal periksa baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'hari' => 'required|string', // Validasi agar hari tidak kosong dan berbentuk string
            'jam_mulai' => 'required|date_format:H:i', // Validasi agar jam mulai sesuai format waktu H:i
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai', // Validasi agar jam selesai lebih besar dari jam mulai
        ]);

        // Cek apakah jadwal dengan waktu dan hari yang sama sudah ada untuk dokter yang sedang login
        $existingSchedule = JadwalPeriksa::where('id_dokter', Auth::guard('dokter')->id())  // Hanya jadwal untuk dokter yang sedang login
            ->where('hari', $request->hari)
            ->where('jam_mulai', $request->jam_mulai)
            ->where('jam_selesai', $request->jam_selesai)
            ->exists(); // Mengecek apakah jadwal sudah ada

        // Jika jadwal sudah ada, tampilkan error
        if ($existingSchedule) {
            return redirect()->back()->with('error', 'Jadwal tidak boleh sama dengan jadwal yang sudah tersedia');
        }

        // Simpan jadwal baru ke dalam database
        JadwalPeriksa::create([
            'id_dokter' => Auth::guard('dokter')->id(), // ID dokter yang sedang login
            'hari' => $request->hari, // Hari untuk jadwal
            'jam_mulai' => $request->jam_mulai, // Jam mulai jadwal
            'jam_selesai' => $request->jam_selesai, // Jam selesai jadwal
            'status' => 0,  // Status default 'nonaktif'
        ]);

        // Redirect dengan pesan sukses setelah jadwal berhasil ditambahkan
        return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Mengubah status jadwal periksa (aktif/nonaktif).
     */
    public function toggleStatus($id)
    {
        // Mencari jadwal berdasarkan ID yang diberikan
        $jadwal = JadwalPeriksa::findOrFail($id);

        // Pastikan hanya satu jadwal yang aktif untuk dokter yang sama
        // Jika status jadwal bukan aktif (1), aktifkan jadwal ini
        if ($jadwal->status !== 1) {
            // Nonaktifkan semua jadwal yang aktif untuk dokter yang sama
            JadwalPeriksa::where('id_dokter', $jadwal->id_dokter)
                ->update(['status' => 0]); // Set status jadwal lain menjadi nonaktif

            // Aktifkan jadwal yang dipilih
            $jadwal->status = 1;
        } else {
            // Jika jadwal sudah aktif, set status menjadi nonaktif
            $jadwal->status = 0;
        }

        // Simpan perubahan status jadwal
        $jadwal->save();

        // Redirect dengan pesan sukses
        return back()->with('success', 'Status jadwal berhasil diubah.');
    }

    /**
     * Memperbarui status jadwal periksa.
     */
    public function update(Request $request, $id)
    {
        // Validasi status (1 = aktif, 0 = nonaktif)
        $request->validate([
            'status' => 'required|in:1,0', // hanya bisa 1 atau 0
        ]);

        // Mencari jadwal berdasarkan ID
        $jadwal = JadwalPeriksa::findOrFail($id);

        // Update status jadwal
        $jadwal->status = $request->status == '1' ? true : false;  // Mengubah 1 ke true, 0 ke false
        $jadwal->save(); // Menyimpan perubahan status

        // Redirect ke halaman daftar jadwal dengan pesan sukses
        return redirect()->route('dokter.jadwal.index')->with('success', 'Status Jadwal Periksa berhasil diperbarui.');
    }

    /**
     * Menghapus jadwal periksa.
     */
    public function destroy($id)
    {
        // Mencari jadwal berdasarkan ID
        $jadwal = JadwalPeriksa::findOrFail($id);

        // Menghapus jadwal dari database
        $jadwal->delete();

        // Redirect ke halaman daftar jadwal dengan pesan sukses
        return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal Periksa berhasil dihapus.');
    }
}
