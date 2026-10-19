<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke tabel user (siswa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke jenis layanan (sesuaikan nama model jenis layanan kamu jika ada)
    public function jenisLayanan()
    {
        return $this->belongsTo(JenisLayanan::class, 'jenis_layanan_id');
    }
}