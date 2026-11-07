<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Foto Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { gpm: { blue: '#0F2C59', gold: '#D4AF37', navy: '#1E3E62' } } } } }
    </script>
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen flex flex-col justify-between">
    <header class="bg-gpm-blue text-white py-4 px-6 shadow-md flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <h1 class="font-bold text-sm tracking-wide">Tambah Foto Galeri - Admin Panel</h1>
        </div>
        <a href="{{ route('admin.gallery.index') }}" class="text-xs bg-gpm-navy px-4 py-2 rounded-lg font-semibold transition">← Kembali</a>
    </header>

    <main class="max-w-xl mx-auto px-6 py-12 flex-grow w-full">
        <div class="bg-white rounded-2xl shadow-xl p-8 border-t-4 border-gpm-gold">
            <h2 class="text-2xl font-bold text-gpm-blue mb-6">Tambah Foto Kegiatan Baru</h2>

            @if($errors->any())
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-3 text-sm text-red-700 rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Pilih File Foto</label>
                    <input type="file" name="image" required accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gpm-blue file:text-white hover:file:bg-gpm-navy">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Judul Kegiatan</label>
                    <input type="text" name="title" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gpm-blue focus:outline-none text-sm" placeholder="Contoh: Ibadah Syukur HUT Gereja">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Keterangan / Deskripsi (Opsional)</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gpm-blue focus:outline-none text-sm" placeholder="Tuliskan keterangan detail kegiatan..."></textarea>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('admin.gallery.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-gpm-blue text-white rounded-lg text-sm font-bold shadow hover:bg-gpm-navy transition">Simpan Foto</button>
                </div>
            </form>
        </div>
    </main>
    <footer class="bg-white py-4 text-center text-xs text-gray-500 border-t">&copy; {{ date('Y') }} GPM Jemaat Seriholo</footer>
</body>
</html>