<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        // Menampilkan view login untuk pengguna yang ingin masuk ke aplikasi
        return view('auth.login');
    }

    /**
     * Menangani permintaan autentikasi pengguna.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Memanggil metode authenticate() dari LoginRequest untuk melakukan autentikasi
        $request->authenticate();

        // Setelah autentikasi berhasil, sesi pengguna akan diperbarui
        $request->session()->regenerate();

        // Mengarahkan pengguna ke halaman yang dituju (defaultnya adalah halaman dashboard admin)
        return redirect()->intended(route('admin.dashboard'));  
    }

    /**
     * Menghancurkan sesi yang sudah terautentikasi.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Menghapus sesi login pengguna menggunakan guard 'web'
        Auth::guard('web')->logout();

        // Menghapus semua data sesi yang tersimpan
        $request->session()->invalidate();

        // Menghasilkan token sesi baru untuk menghindari serangan CSRF
        $request->session()->regenerateToken();

        // Setelah logout, mengarahkan pengguna kembali ke halaman utama
        return redirect('/');
    }
}
