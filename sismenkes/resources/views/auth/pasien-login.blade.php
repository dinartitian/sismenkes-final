<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Menampilkan status sesi, jika ada. Biasanya digunakan untuk menampilkan pesan status (seperti sukses login) -->

    <form method="POST" action="{{ route('pasien.login') }}">
        <!-- Formulir yang dikirimkan menggunakan metode POST ke route 'pasien.login' untuk login pasien -->
        @csrf
        <!-- Token CSRF untuk mencegah serangan Cross-Site Request Forgery (CSRF). Laravel secara otomatis mengelola ini untuk keamanan -->

        <!-- Nama Pasien -->
        <div>
            <x-input-label for="nama" :value="__('Nama Pasien')" />
            <!-- Label untuk kolom nama pasien. `__('Nama Pasien')` memastikan bahwa label ini diterjemahkan jika menggunakan lokal yang berbeda -->

            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required
                autofocus autocomplete="username" />
            <!-- Input untuk nama pasien.
                 - `old('nama')` digunakan untuk mempertahankan nilai nama yang dimasukkan sebelumnya jika form dikirimkan dengan kesalahan.
                 - `required` memastikan input ini wajib diisi.
                 - `autofocus` memastikan kolom ini otomatis disorot saat halaman dimuat.
                 - `autocomplete="username"` memberikan petunjuk kepada browser untuk menyarankan nilai yang sudah pernah dimasukkan sebelumnya -->
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada kesalahan pada input nama pasien (misalnya nama tidak valid) -->
        </div>

        <!-- Alamat Pasien -->
        <div class="mt-4">
            <x-input-label for="alamat" :value="__('Alamat Pasien')" />
            <!-- Label untuk input field Alamat Pasien -->

            <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')"
                required autocomplete="address" />
            <!-- Input untuk alamat pasien.
                 - `old('alamat')` untuk mengisi kembali nilai alamat yang dimasukkan sebelumnya jika ada kesalahan dalam pengisian formulir.
                 - `required` memastikan kolom ini wajib diisi.
                 - `autocomplete="address"` memberi petunjuk pada browser agar mengisi otomatis berdasarkan alamat yang sudah disimpan sebelumnya -->
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada kesalahan pada input alamat pasien -->
        </div>

        <div class="flex items-center justify-end mt-4">
            <!-- Bagian untuk tombol kirim formulir -->
            <x-primary-button class="ms-3">
                {{ __('Login Pasien') }}
            </x-primary-button>
            <!-- Tombol untuk mengirimkan formulir dengan teks "Login Pasien" yang akan diterjemahkan sesuai dengan lokal yang digunakan -->
        </div>
    </form>
</x-guest-layout>
<!-- Menutup komponen layout guest -->
