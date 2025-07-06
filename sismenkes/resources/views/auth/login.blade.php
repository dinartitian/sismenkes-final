<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Menampilkan status sesi yang mungkin ada, seperti pesan status login yang berhasil atau gagal -->

    <form method="POST" action="{{ route('login') }}">
        <!-- Formulir yang dikirimkan dengan metode POST ke route 'login' untuk memproses login -->
        @csrf
        <!-- Menyertakan token CSRF untuk mencegah serangan Cross-Site Request Forgery (CSRF) -->

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <!-- Label untuk kolom email. `__('Email')` akan menampilkan teks sesuai dengan lokal yang digunakan (misalnya dalam bahasa Indonesia jika ada terjemahan) -->

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <!-- Input untuk email pengguna. Atribut:
                 - `old('email')`: Menampilkan nilai email yang dimasukkan sebelumnya jika ada kesalahan validasi.
                 - `required`: Memastikan input ini wajib diisi.
                 - `autofocus`: Fokus otomatis pada kolom ini saat halaman dimuat.
                 - `autocomplete="username"`: Memberikan petunjuk kepada browser untuk mengisi nilai username atau email secara otomatis berdasarkan data yang telah disimpan -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <!-- Menampilkan pesan error terkait input email, jika ada (misalnya email tidak valid atau kosong) -->
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <!-- Label untuk kolom password -->

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <!-- Input untuk password pengguna. Atribut:
                 - `required`: Memastikan kolom password wajib diisi.
                 - `autocomplete="current-password"`: Memberikan petunjuk kepada browser untuk mengisi password yang telah disimpan sebelumnya -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <!-- Menampilkan pesan error terkait input password, jika ada (misalnya password kosong atau salah) -->
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <!-- Checkbox untuk memilih opsi "Remember me" (ingat saya), agar pengguna tetap login setelah sesi berakhir -->
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                <!-- Teks "Remember me", yang bisa diterjemahkan tergantung pada lokal yang digunakan -->
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <!-- Tombol dan tautan di bagian bawah formulir -->

            @if (Route::has('password.request'))
                <!-- Jika route untuk permintaan password lupa tersedia, tampilkan tautan ke halaman permintaan password -->
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
            <!-- Tombol untuk mengirim formulir login dengan teks "Log in". Teks ini juga dapat diterjemahkan sesuai dengan lokal yang digunakan -->
        </div>
    </form>
</x-guest-layout>
<!-- Menutup komponen layout guest -->
