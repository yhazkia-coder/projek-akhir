<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Direct URL utama (http://127.0.0.1:8000/) langsung ke halaman /login
Route::get('/', function () {
    return redirect()->route('login');
});

// Group Route Guest (Hanya bisa diakses jika BELUM login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Group Route Auth (Hanya bisa diakses jika SUDAH login)
Route::middleware('auth')->group(function () {
    // Route Kelola Profil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // TAMBAHKAN ROUTE DASHBOARD DI SINI:
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Sesuaikan dengan nama file view admin kamu
    })->name('admin.dashboard');

    Route::get('/siswa/dashboard', function () {
        return view('siswa.dashboard'); // Sesuaikan dengan nama file view siswa kamu
    })->name('siswa.dashboard');

    // Route Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {
    // Route Dashboard Admin (Tambahkan Route:: di depannya)
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Route Aksi Admin (Tambahkan Route:: di depannya)
    Route::put('/admin/pengajuan/{id}/validasi', [AdminController::class, 'validasi'])->name('admin.pengajuan.validasi');
    Route::put('/admin/pengajuan/{id}/serahkan', [AdminController::class, 'serahkan'])->name('admin.pengajuan.serahkan');
});

Route::middleware('auth')->group(function () {
    // Route Dashboard Siswa
    Route::get('/siswa/dashboard', [StudentController::class, 'index'])->name('siswa.dashboard');
    Route::post('/siswa/pengajuan', [StudentController::class, 'store'])->name('siswa.pengajuan.store');
});