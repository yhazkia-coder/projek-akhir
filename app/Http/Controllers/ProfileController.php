<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan Halaman Edit Profil
    public function edit()
    {
        return view('profile.edit');
    }

    // Memproses Perubahan Profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi Input
        $request->validate([
            'name'        => 'required|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required'     => 'Nama tidak boleh kosong.',
            'foto_profil.image' => 'Berkas harus berupa gambar.',
            'foto_profil.max'   => 'Ukuran foto maksimal 2MB.',
        ]);

        // 2. Update Nama
        $user->name = $request->name;

        // 3. Proses Upload Foto Profil Baru (jika ada)
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama dari storage jika ada
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            // Simpan foto baru ke folder storage/app/public/profile-photos
            $path = $request->file('foto_profil')->store('profile-photos', 'public');
            $user->foto_profil = $path;
        }

        // 4. Simpan ke Database
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}