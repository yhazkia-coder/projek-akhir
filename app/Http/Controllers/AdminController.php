<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan; // Pastikan model Pengajuan sudah ada

class AdminController extends Controller
{
    // 1. Menampilkan semua data pengajuan di Dashboard Admin
    public function index()
    {
        // Mengambil semua data pengajuan beserta relasi user dan jenis layanan
        $pengajuans = Pengajuan::with(['user', 'jenisLayanan'])->latest()->get();
        
        return view('admin.dashboard', compact('pengajuans'));
    }

    // 2. Aksi Validasi Pengajuan
    public function validasi($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'Valid'; // Atau 'Disetujui'
        $pengajuan->save();

        return back()->with('success', 'Pengajuan berhasil divalidasi!');
    }

    // 3. Aksi Serahkan Dokumen
    public function serahkan($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'Selesai / Diserahkan';
        $pengajuan->save();

        return back()->with('success', 'Dokumen berhasil diserahkan kepada siswa!');
    }
}