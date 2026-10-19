<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - my-report</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex flex-col">

    <!-- Top Navigation Bar -->
    <header class="bg-blue-900 text-white shadow-md">
        <div class="px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="font-bold text-lg tracking-wide">my-report</span>
                <span class="text-xs bg-blue-800 px-2.5 py-1 rounded-full text-blue-200">Admin Panel</span>
            </div>
            <div class="flex items-center space-x-4 text-sm">
                <!-- Tautan Kelola Profil dari Nama Admin -->
                <a href="{{ route('profile.edit') }}" class="hover:underline flex items-center space-x-2">
                    @if(Auth::user()->foto_profil)
                        <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" alt="Foto" class="w-7 h-7 rounded-full object-cover border border-blue-300">
                    @endif
                    <span>Halo, <strong class="text-blue-200">{{ Auth::user()->name ?? 'Admin TU' }}</strong></span>
                </a>
                
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1.5 rounded transition duration-150">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Layout (Sidebar + Main Content) -->
    <div class="flex flex-1">
        
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-slate-800 text-slate-300 flex-shrink-0 hidden md:block">
            <nav class="p-4 space-y-1.5 text-sm font-medium">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 bg-blue-600 text-white rounded-lg">
                    <span>Dashboard</span>
                </a>
                
                <!-- Menu Kelola Profil Baru -->
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-2.5 hover:bg-slate-700 rounded-lg transition">
                    <span>Kelola Profil</span>
                </a>

                <a href="#" class="flex items-center space-x-3 px-4 py-2.5 hover:bg-slate-700 rounded-lg transition">
                    <span>Master Data Siswa</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-2.5 hover:bg-slate-700 rounded-lg transition">
                    <span>Master Jenis Layanan</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-2.5 hover:bg-slate-700 rounded-lg transition">
                    <span>Verifikasi Pengajuan</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-2.5 hover:bg-slate-700 rounded-lg transition">
                    <span>Pencatatan Penyerahan</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-2.5 hover:bg-slate-700 rounded-lg transition">
                    <span>Cetak Laporan</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 md:p-8 overflow-y-auto">
            
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-slate-800">Dashboard Ringkasan</h1>
                <p class="text-xs text-slate-500 mt-1">Sistem Informasi Manajemen Dokumen Akademik Siswa SMK Negeri 5 Surakarta</p>
            </div>

            <!-- Summary Statistic Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <!-- Card 1: Total Pengajuan -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                    <p class="text-xs font-semibold text-slate-500 uppercase">Total Pengajuan</p>
                    <p class="text-2xl font-bold text-slate-800 mt-2">128</p>
                </div>
                <!-- Card 2: Perlu Verifikasi (Pending) -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-amber-500">
                    <p class="text-xs font-semibold text-amber-600 uppercase">Perlu Verifikasi</p>
                    <p class="text-2xl font-bold text-slate-800 mt-2">12</p>
                </div>
                <!-- Card 3: Disetujui (Approved) -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-emerald-500">
                    <p class="text-xs font-semibold text-emerald-600 uppercase">Disetujui</p>
                    <p class="text-2xl font-bold text-slate-800 mt-2">102</p>
                </div>
                <!-- Card 4: Ditolak (Rejected) -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-rose-500">
                    <p class="text-xs font-semibold text-rose-600 uppercase">Ditolak</p>
                    <p class="text-2xl font-bold text-slate-800 mt-2">14</p>
                </div>
            </div>

            <!-- Recent Activity Table Section -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                    <h2 class="font-bold text-slate-800 text-sm">Daftar Verifikasi Pengajuan Terbaru</h2>
                    <a href="#" class="text-xs font-medium text-blue-600 hover:underline">Lihat Semua Data &rarr;</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="px-5 py-3">No. Pengajuan</th>
                                <th class="px-5 py-3">Nama Siswa</th>
                                <th class="px-5 py-3">Layanan</th>
                                <th class="px-5 py-3">Tgl Booking</th>
                                <th class="px-5 py-3">Status</th>
                                <th class="px-5 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-3.5 font-medium text-slate-800">REQ-202609-001</td>
                                <td class="px-5 py-3.5">Yahya</td>
                                <td class="px-5 py-3.5">Legalisir Ijazah</td>
                                <td class="px-5 py-3.5">16/09/2026</td>
                                <td class="px-5 py-3.5">
                                    <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-2.5 py-1 rounded-full">PENDING</span>
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <button class="bg-amber-500 hover:bg-amber-600 text-white text-xs px-3 py-1.5 rounded transition">Detail & Validasi</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-3.5 font-medium text-slate-800">REQ-202609-002</td>
                                <td class="px-5 py-3.5">Ahmad Basiro</td>
                                <td class="px-5 py-3.5">Pinjam Rapor Asli</td>
                                <td class="px-5 py-3.5">17/09/2026</td>
                                <td class="px-5 py-3.5">
                                    <span class="bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-1 rounded-full">APPROVED</span>
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <button class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs px-3 py-1.5 rounded transition">Serahkan</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

</body>
</html>