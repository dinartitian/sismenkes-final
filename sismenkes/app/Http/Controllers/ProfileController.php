<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan form untuk mengedit profil pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request): View
    {
        // Menampilkan halaman form edit profil dengan data pengguna yang sedang login
        return view('profile.edit', [
            'user' => $request->user(), // Mengirim data pengguna yang sedang login ke view
        ]);
    }

    /**
     * Memperbarui informasi profil pengguna.
     *
     * @param \App\Http\Requests\ProfileUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mengisi model pengguna dengan data yang telah divalidasi
        $request->user()->fill($request->validated());

        // Jika email pengguna diubah, set email_verified_at menjadi null
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Menyimpan perubahan data pengguna ke database
        $request->user()->save();

        // Mengarahkan pengguna kembali ke halaman edit profil dengan pesan status sukses
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Menghapus akun pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi untuk memastikan bahwa pengguna memasukkan password yang benar sebelum penghapusan
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'], // Password yang dimasukkan harus sesuai dengan password saat ini
        ]);

        // Mengambil data pengguna yang sedang login
        $user = $request->user();

        // Melakukan logout pengguna
        Auth::logout();

        // Menghapus akun pengguna
        $user->delete();

        // Menonaktifkan sesi dan menghapus token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mengarahkan pengguna ke halaman utama setelah penghapusan akun
        return Redirect::to('/');
    }
}
