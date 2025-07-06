<x-guest-layout>
    <!-- Formulir pendaftaran pasien -->
    <form method="POST" action="{{ route('register') }}">
        <!-- Formulir menggunakan metode POST untuk mengirim data pendaftaran ke route 'register' -->
        @csrf
        <!-- Menyertakan token CSRF untuk melindungi formulir dari serangan CSRF. Token ini akan diproses otomatis oleh Laravel -->

        <!-- Nama -->
        <div>
            <x-input-label for="nama" :value="__('Nama')" />
            <!-- Menampilkan label untuk input nama pasien, `__('Nama')` memastikan label ini diterjemahkan jika ada lokal berbeda -->

            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required
                autofocus autocomplete="nama" />
            <!-- Input untuk nama pasien. Beberapa atribut:
                 - `old('nama')`: Menjaga nilai input nama jika formulir dikirimkan dengan kesalahan (mencegah hilangnya data).
                 - `required`: Memastikan kolom ini wajib diisi.
                 - `autofocus`: Menempatkan fokus otomatis pada kolom ini saat halaman dimuat.
                 - `autocomplete="nama"`: Mengaktifkan autofill untuk nama yang sebelumnya dimasukkan di browser -->
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada kesalahan pada input nama (misalnya kosong atau format salah) -->
        </div>

        <!-- Alamat -->
        <div class="mt-4">
            <x-input-label for="alamat" :value="__('Alamat')" />
            <!-- Menampilkan label untuk input alamat pasien -->

            <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')"
                required autocomplete="alamat" />
            <!-- Input untuk alamat pasien. Beberapa atribut:
                 - `old('alamat')`: Menjaga nilai alamat yang dimasukkan sebelumnya.
                 - `required`: Kolom ini wajib diisi.
                 - `autocomplete="alamat"`: Menyediakan saran alamat yang sebelumnya dimasukkan -->
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada kesalahan dalam pengisian alamat -->
        </div>

        <!-- No KTP -->
        <div class="mt-4">
            <x-input-label for="no_ktp" :value="__('No KTP')" />
            <!-- Menampilkan label untuk input nomor KTP pasien -->

            <x-text-input id="no_ktp" class="block mt-1 w-full" type="number" name="no_ktp" :value="old('no_ktp')"
                required autocomplete="no_ktp" />
            <!-- Input untuk nomor KTP pasien. Beberapa atribut:
                 - `old('no_ktp')`: Mempertahankan nilai nomor KTP jika ada kesalahan.
                 - `required`: Kolom ini wajib diisi.
                 - `autocomplete="no_ktp"`: Menyediakan saran atau pengisian otomatis nomor KTP yang sebelumnya dimasukkan -->
            <x-input-error :messages="$errors->get('no_ktp')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada kesalahan dalam pengisian nomor KTP -->
        </div>

        <!-- No HP -->
        <div class="mt-4">
            <x-input-label for="no_hp" :value="__('No HP')" />
            <!-- Menampilkan label untuk input nomor HP pasien -->

            <x-text-input id="no_hp" class="block mt-1 w-full" type="number" name="no_hp" :value="old('no_hp')"
                required autocomplete="no_hp" />
            <!-- Input untuk nomor HP pasien. Beberapa atribut:
                 - `old('no_hp')`: Mempertahankan nilai nomor HP yang dimasukkan sebelumnya.
                 - `required`: Kolom ini wajib diisi.
                 - `autocomplete="no_hp"`: Menyediakan saran atau pengisian otomatis nomor HP yang sebelumnya dimasukkan -->
            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
            <!-- Menampilkan pesan error jika ada kesalahan dalam pengisian nomor HP -->
        </div>

        <!-- Bagian Tombol Kirim Formulir -->
        <div class="flex items-center justify-end mt-4">
            <!-- Menyusun bagian tombol daftar dan link ke halaman login jika sudah punya akun -->

            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Sudah Punya Akun Pasien ?') }}
            </a>
            <!-- Tautan ke halaman login pasien jika sudah memiliki akun. Teks bisa diterjemahkan jika menggunakan sistem lokal -->

            <x-primary-button class="ms-4">
                {{ __('Daftar Pasien') }}
            </x-primary-button>
            <!-- Tombol untuk mengirim formulir dengan teks "Daftar Pasien" yang akan diterjemahkan jika menggunakan lokal yang sesuai -->
        </div>
    </form>
</x-guest-layout>
<!-- Menutup komponen layout guest -->
