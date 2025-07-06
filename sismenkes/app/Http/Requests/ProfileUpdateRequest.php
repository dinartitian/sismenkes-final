<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Mendapatkan aturan validasi yang diterapkan pada request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],  // Nama harus diisi, berupa string, dan maksimal 255 karakter
            'email' => [
                'required', // Email wajib diisi
                'string',  // Email harus berbentuk string
                'lowercase', // Email harus dalam format huruf kecil
                'email', // Memastikan format email valid
                'max:255', // Panjang email maksimal 255 karakter
                Rule::unique(User::class)->ignore($this->user()->id), // Memastikan email unik, kecuali untuk pengguna yang sedang diperbarui (mengabaikan ID pengguna yang sedang login)
            ],
        ];
    }
}
