<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user') ? $this->route('user')->id : null;

        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email,' . $userId,
            'password'  => $userId ? 'nullable|string|min:8' : 'required|string|min:8',
            'npm'       => 'nullable|string|max:20',
            'prodi'     => 'nullable|string|max:100',
            'nohp'      => 'nullable|string|max:20',
            'role'      => 'required|string|in:superadmin,admin,dekan,wakil_dekan_I,mahasiswa',
            'is_aktive' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name'      => 'Nama Lengkap',
            'email'     => 'Alamat Email',
            'password'  => 'Password',
            'npm'       => 'NPM / NUP',
            'prodi'     => 'Program Studi',
            'nohp'      => 'Nomor HP',
            'role'      => 'Role/Peran',
            'is_aktive' => 'Status Aktif',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'unique'   => ':attribute sudah terdaftar.',
            'email'    => 'Format :attribute tidak valid.',
            'min'      => ':attribute minimal :min karakter.',
            'in'       => ':attribute yang dipilih tidak valid.',
        ];
    }
}
