<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Keterangan Foto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { gpm: { blue: '#0F2C59', gold: '#D4AF37', navy: '#1E3E62' } } } } }
    </script>
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen flex flex-col">
    <main class="max-w-xl mx-auto px-6 py-12 flex-grow w-full">
        <div class="bg-white rounded-2xl shadow-xl p-8 border-t-4 border-gpm-gold">
            <h2 class="text-2xl font-bold text-gpm-blue mb-6">Edit Keterangan / Foto</h2>

            <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div class="mb-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Foto Saat Ini</label>
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="" class="w-32 h-32 object-cover rounded-lg shadow-sm mb-2">
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gpm-blue file:text-white">
                    <p class="text-[11px] text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengganti foto.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Judul Kegiatan</label>
                    <input type="text" name="title" value="{{ $gallery->title }}" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gpm-blue focus:outline-none text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Keterangan / Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gpm-blue focus:outline-none text-sm">{{ $gallery->description }}</textarea>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('admin.gallery.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-300 transition">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-gpm-blue text-white rounded-lg text-sm font-bold shadow hover:bg-gpm-navy transition">Perbarui Perubahan</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>