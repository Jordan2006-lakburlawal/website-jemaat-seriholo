<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Ibadah - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { gpm: { blue: '#0F2C59', gold: '#D4AF37', navy: '#1E3E62' } } } } }
    </script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <div class="container mx-auto px-6 py-8 max-w-2xl">
        <h2 class="text-2xl font-bold text-gpm-blue mb-6">Edit Jadwal Ibadah</h2>

        <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Nama Ibadah</label>
                <input type="text" name="nama_ibadah" value="{{ old('nama_ibadah', $jadwal->nama_ibadah) }}" class="w-full border rounded p-2 text-sm focus:ring-2 focus:ring-gpm-blue outline-none" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Waktu Ibadah</label>
                <input type="datetime-local" name="waktu" value="{{ old('waktu', date('Y-m-d\TH:i', strtotime($jadwal->waktu))) }}" class="w-full border rounded p-2 text-sm focus:ring-2 focus:ring-gpm-blue outline-none" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Tempat</label>
                <input type="text" name="tempat" value="{{ old('tempat', $jadwal->tempat) }}" class="w-full border rounded p-2 text-sm focus:ring-2 focus:ring-gpm-blue outline-none" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Pelayan Firman</label>
                <input type="text" name="pelayan_firman" value="{{ old('pelayan_firman', $jadwal->pelayan_firman) }}" class="w-full border rounded p-2 text-sm focus:ring-2 focus:ring-gpm-blue outline-none" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Bacaan Firman</label>
                <input type="text" name="bacaan_firman" value="{{ old('bacaan_firman', $jadwal->bacaan_firman) }}" class="w-full border rounded p-2 text-sm focus:ring-2 focus:ring-gpm-blue outline-none" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Ganti File Liturgi (PDF / DOC)</label>
                @if($jadwal->file_liturgi)
                    <p class="text-xs text-blue-600 mb-1">File saat ini: <a href="{{ asset($jadwal->file_liturgi) }}" target="_blank" class="underline font-medium">Lihat File PDF</a></p>
                @endif
                <input type="file" name="file_liturgi" class="w-full border rounded p-2 text-sm bg-gray-50">
            </div>
            
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded text-sm font-semibold transition">Batal</a>
                <button type="submit" class="bg-gpm-blue hover:bg-gpm-navy text-white px-6 py-2 rounded text-sm font-semibold transition">Perbarui Jadwal</button>
            </div>
        </form>
    </div>
</body>
</html>