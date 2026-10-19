<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\JenisLayanan;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // Menampilkan Dashboard Siswa & Daftar Pengajuannya Sendiri
    public function index()
    {
        // Ambil data pengajuan milik user yang sedang login saja
        $pengajuans = Pengajuan::with('jenisLayanan')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();

        // Ambil daftar layanan untuk form pengajuan baru jika dibutuhkan
        $jenisLayanans = JenisLayanan::all();

        return view('siswa.dashboard', compact('pengajuans', 'jenisLayanans'));
    }

    // Menyimpan Pengajuan Baru dari Siswa
    public function store(Request $request)
    {
        $request->validate([
            'jenis_layanan_id' => 'required|exists:jenis_layanans,id',
            'keterangan'       => 'nullable|string',
        ]);

        // Buat nomor pengajuan otomatis, contoh: REQ-20261019-XXXX
        $noPengajuan = 'REQ-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        Pengajuan::create([
            'no_pengajuan'     => $noPengajuan, // <-- TAMBAHKAN KOLOM INI
            'user_id'          => Auth::id(),
            'jenis_layanan_id' => $request->jenis_layanan_id,
            'keterangan'       => $request->keterangan,
            'status'           => 'Pending', // Status awal
        ]);

        return back()->with('success', 'Pengajuan dokumen berhasil dikirim!');
    }}