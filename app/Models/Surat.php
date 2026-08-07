<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'user_id',
        'slug',
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

    protected static function booted()
    {
        static::creating(function ($surat) {
            if (empty($surat->slug)) {
                $surat->slug = static::generateUniqueSlug($surat->jenis_surat, $surat->kodepro);
            }
        });
    }

    public static function generateUniqueSlug($jenisSurat, $kodepro = null)
    {
        $base = \Illuminate\Support\Str::slug(($jenisSurat ?? 'surat') . '-' . ($kodepro ?? rand(100, 999)));
        $slug = $base . '-' . \Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(6));
        while (static::where('slug', $slug)->exists()) {
            $slug = $base . '-' . \Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(6));
        }
        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? $this->getRouteKeyName(), $value)
            ->orWhere('id', $value)
            ->firstOrFail();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
