<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $mahasiswaId = $this->route('mahasiswa') ? $this->route('mahasiswa')->id : null;
        $userId = $this->route('mahasiswa') ? $this->route('mahasiswa')->user_id : null;

        return [
            'npm'   => ['required', 'string', 'max:50', 'unique:users,npm,' . $userId, 'unique:mahasiswas,npm,' . $mahasiswaId],
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $userId],
            'nohp'  => ['required', 'string', 'max:20'],
            'prodi' => ['required', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'npm.required'   => 'NPM wajib diisi.',
            'npm.unique'     => 'NPM sudah terdaftar.',
            'name.required'  => 'Nama mahasiswa wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah terdaftar.',
            'nohp.required'  => 'Nomor HP wajib diisi.',
            'prodi.required' => 'Program studi wajib dipilih.',
        ];
    }
}
