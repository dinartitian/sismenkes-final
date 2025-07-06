<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Menampilkan status sesi, jika ada. Biasanya digunakan untuk menampilkan pesan status (seperti sukses login) -->

    <form method="POST" action="{{ route('dokter.login') }}">
        <!-- Formulir yang dikirimkan menggunakan metode POST ke route 'dokter.login' untuk login dokter -->
        @csrf
        <!-- Token CSRF untuk mencegah serangan CSRF. Laravel secara otomatis mengelola ini untuk keamanan -->

        <!-- Nama Dokter -->
        <div>
            <x-input-label for="nama" :value="__('Nama Dokter')" />
            <!-- Label untuk input field Nama Dokter. `__('Nama Dokter')` memastikan bahwa label ini diterjemahkan jika menggunakan lokal berbeda -->

            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required
                autofocus autocomplete="username" />
            <!-- Input untuk nama dokter.
                 - `old('nama')` untuk mempertahankan nilai sebelumnya jika form dikirimkan dengan kesalahan.
                 - `required` memastikan input ini wajib diisi.
                 - `autofocus` memastikan kolom ini otomatis disorot saat halaman dimuat.
                 - `autocomplete="username"` untuk memberi petunjuk pada browser agar menampilkan saran input sebelumnya -->
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada kesalahan pada input nama (misalnya nama tidak valid) -->
        </div>

        <!-- Alamat Dokter -->
        <div class="mt-4">
            <x-input-label for="alamat" :value="__('Alamat Dokter')" />
            <!-- Label untuk input field Alamat Dokter -->

            <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')"
                required autocomplete="address" />
            <!-- Input untuk alamat dokter.
                 - `old('alamat')` untuk mempertahankan nilai yang dimasukkan jika terjadi kesalahan dalam pengisian formulir.
                 - `required` memastikan kolom ini wajib diisi.
                 - `autocomplete="address"` memberi petunjuk kepada browser untuk menyarankan alamat yang sebelumnya telah dimasukkan -->
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada kesalahan pada input alamat -->
        </div>

        <div class="flex items-center justify-end mt-4">
            <!-- Bagian tombol kirim formulir -->
            <x-primary-button class="ms-3">
                {{ __('Login Dokter') }}
            </x-primary-button>
            <!-- Tombol untuk mengirim formulir. Teks tombol "Login Dokter" akan diterjemahkan jika menggunakan sistem lokal -->
        </div>
    </form>
</x-guest-layout>
<!-- Menutup layout guest -->
