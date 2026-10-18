<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Direct URL utama (http://127.0.0.1:8000/) langsung ke halaman /login
Route::get('/', function () {
    return redirect()->route('login');
});

// Group Route Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/admin/dashboard', [AdminConrtoller::class, 'index'])->name('admin.dashboard');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});