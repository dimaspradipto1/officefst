<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratRequest extends FormRequest
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
        return [
            'jenis_surat' => 'required|string',
            'judul_penelitian' => 'nullable|string',
            'tujuan' => 'required|string',
            'nama_perusahaan' => 'required|string',
            'alamat_perusahaan' => 'required|string',
            'nohp_perusahaan' => 'required|string',
        ];
    }
}
