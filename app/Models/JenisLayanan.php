<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLayanan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke tabel pengajuan
    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'jenis_layanan_id');
    }
}