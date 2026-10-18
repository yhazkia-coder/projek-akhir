<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Profil - E-Doc Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-100 min-h-screen">

    <!-- Header Navigation -->
    <header class="bg-blue-900 text-white shadow-md">
        <div class="px-6 py-4 flex justify-between items-center max-w-6xl mx-auto">
            <div class="flex items-center space-x-3">
                <span class="font-bold text-lg">E-DOC AKADEMIK</span>
                <span class="text-xs bg-blue-800 px-2.5 py-1 rounded-full text-blue-200">Kelola Profil</span>
            </div>
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : url('/siswa/dashboard') }}" 
               class="text-xs bg-slate-700 hover:bg-slate-600 px-3 py-1.5 rounded text-white transition">
                &larr; Kembali ke Dashboard
            </a>
        </div>
    </header>

    <main class="max-w-3xl mx-auto p-6 mt-6">
        
        <!-- Card Profile Form -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h1 class="text-xl font-bold text-slate-800">Edit Profil Pengguna</h1>
                <p class="text-xs text-slate-500 mt-1">Perbarui nama lengkap, informasi akun, dan foto profil Anda.</p>
            </div>

            <div class="p-6">
                <!-- Alert Success -->
                @if(session('success'))
                    <div class="mb-5 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form Upload (Wajib enctype="multipart/form-data") -->
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Preview Foto Profil & Upload Field -->
                    <div class="mb-6 flex items-center space-x-6">
                        <div class="relative">
                            @if(Auth::user()->foto_profil)
                                <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" 
                                     alt="Foto Profil" class="w-24 h-24 rounded-full object-cover border-2 border-blue-600 shadow">
                            @else
                                <div class="w-24 h-24 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold text-2xl border-2 border-slate-300">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Ganti Foto Profil</label>
                            <input type="file" name="foto_profil" accept="image/*"
                                class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (Maksimal 2MB)</p>
                            @error('foto_profil')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Nama Lengkap -->
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">Nama Lengkap / Username</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                            class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Email / NISN (Disabled Input) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase mb-2">Email</label>
                            <input type="text" value="{{ Auth::user()->email ?? '-' }}" disabled
                                class="w-full px-4 py-2.5 text-sm bg-slate-100 border border-slate-200 rounded-lg text-slate-500 cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase mb-2">NISN</label>
                            <input type="text" value="{{ Auth::user()->nisn ?? '-' }}" disabled
                                class="w-full px-4 py-2.5 text-sm bg-slate-100 border border-slate-200 rounded-lg text-slate-500 cursor-not-allowed">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end border-t border-slate-100 pt-4">
                        <button type="submit" 
                            class="bg-blue-900 hover:bg-blue-800 text-white font-semibold py-2.5 px-5 rounded-lg text-sm shadow transition duration-150">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </main>

</body>
</html>