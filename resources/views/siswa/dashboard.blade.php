<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - My Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar / Header -->
    <nav class="bg-blue-900 text-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Dashboard Siswa / Alumni</h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 px-3 py-1 rounded text-xs hover:bg-red-700">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Ajukan Dokumen Baru -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Buat Pengajuan Dokumen Baru</h3>
            <form action="{{ route('siswa.pengajuan.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Jenis Layanan</label>
                    <select name="jenis_layanan_id" class="w-full border rounded p-2 text-sm" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($jenisLayanans as $layanan)
                            <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Keterangan / Keperluan (Opsional)</label>
                    <input type="text" name="keterangan" placeholder="Contoh: Untuk syarat pendaftaran kuliah" class="w-full border rounded p-2 text-sm">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded text-sm hover:bg-blue-700">
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Riwayat Pengajuan -->
        <div class="bg-white rounded-lg shadow overflow-hidden p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Riwayat Pengajuan Dokumen Saya</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Jenis Layanan</th>
                        <th class="px-6 py-3">Keterangan</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Tanggal Pengajuan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse($pengajuans as $index => $item)
                        <tr>
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $item->jenisLayanan->nama_layanan ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->keterangan ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $item->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">{{ $item->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Kamu belum pernah mengajukan dokumen.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>