<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'user_id',
        'no_unik',
        'name',
        'prodi',
        'no_surat',
        'kodepro',
        'tujuan',
        'nama_perusahaan',
        'alamat_perusahaan',
        'nohp_perusahaan',
        'status',
        'judul_penelitian',
        'jenis_surat',
        'tgl_disetujui',
        'tgl_estimasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
