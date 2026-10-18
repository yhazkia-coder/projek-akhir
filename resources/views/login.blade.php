<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Doc Akademik SMKN 5 Surakarta</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <!-- Card Login Container -->
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
        
        <!-- Header Card -->
        <div class="bg-blue-900 px-6 py-8 text-center text-white">
            <div class="inline-flex p-3 bg-blue-800 rounded-full mb-3">
                <svg class="w-8 h-8 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold tracking-wide">my-report</h1>
            <p class="text-xs text-blue-200 mt-1">SMK Negeri 5 Surakarta</p>
        </div>

        <!-- Form Section -->
        <div class="p-6 sm:p-8">
            
            <!-- Notifikasi Session Error (jika ada) -->
            @if(session('error'))
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <!-- Input Email / NISN -->
                <div class="mb-5">
                    <label for="login" class="block text-xs font-semibold text-slate-700 uppercase mb-2">
                        Email atau NISN
                    </label>
                    <input type="text" id="login" name="login" value="{{ old('login') }}" required autofocus
                        class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition duration-150 @error('login') border-red-500 @enderror"
                        placeholder="Masukkan Email (Admin) atau NISN (Siswa)">
                    @error('login')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Password -->
                <div class="mb-5">
                    <label for="password" class="block text-xs font-semibold text-slate-700 uppercase mb-2">
                        Password
                    </label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition duration-150 @error('password') border-red-500 @enderror"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-6 text-xs">
                    <label class="inline-flex items-center text-slate-600">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2">Ingat Saya</span>
                    </label>
                    <a href="#" class="text-blue-600 font-medium hover:underline">Lupa Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                    class="w-full bg-blue-900 hover:bg-blue-800 text-white font-semibold py-3 px-4 rounded-lg shadow-md transition duration-200 text-sm">
                    MASUK KE SISTEM
                </button>
            </form>

        </div>

        <!-- Footer Card -->
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 text-center text-xs text-slate-500">
            &copy; 2026 SMK Negeri 5 Surakarta. All rights reserved.
        </div>
    </div>

</body>
</html>