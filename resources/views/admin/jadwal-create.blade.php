<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Ibadah - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { gpm: { blue: '#0F2C59', gold: '#D4AF37' } } } } }
    </script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto px-6 py-8 max-w-2xl">
        <h2 class="text-2xl font-bold text-gpm-blue mb-6">Tambah Jadwal Ibadah Baru</h2>

        <form action="{{ route('admin.jadwal.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nama Ibadah</label>
                <input type="text" name="nama_ibadah" class="w-full border rounded p-2 focus:ring-2 focus:ring-gpm-blue outline-none" required placeholder="Contoh: Ibadah Minggu Sektor 1">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Waktu Ibadah</label>
                <input type="datetime-local" name="waktu" class="w-full border rounded p-2 focus:ring-2 focus:ring-gpm-blue outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tempat</label>
                <input type="text" name="tempat" class="w-full border rounded p-2 focus:ring-2 focus:ring-gpm-blue outline-none" required placeholder="Contoh: Gedung Gereja Seriholo">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Pelayan Firman</label>
                <input type="text" name="pelayan_firman" class="w-full border rounded p-2 focus:ring-2 focus:ring-gpm-blue outline-none" required placeholder="Contoh: Pdt. ...">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Bacaan Firman</label>
                <input type="text" name="bacaan_firman" class="w-full border rounded p-2 focus:ring-2 focus:ring-gpm-blue outline-none" required placeholder="Contoh: Mazmur 23: 1-6">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Upload File Liturgi (PDF / DOC)</label>
                <input type="file" name="file_liturgi" class="w-full border rounded p-2 text-sm">
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-300 px-4 py-2 rounded text-sm font-semibold">Batal</a>
                <button type="submit" class="bg-gpm-blue text-white px-6 py-2 rounded text-sm font-semibold hover:bg-gpm-navy">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>