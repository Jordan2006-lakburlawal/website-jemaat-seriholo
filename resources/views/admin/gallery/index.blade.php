<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Galeri - Admin Panel</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gpm: {
                            blue: '#0F2C59',
                            gold: '#D4AF37',
                            navy: '#1E3E62'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen flex flex-col justify-between">

    <!-- Navbar Admin -->
    <header class="bg-gpm-blue text-white py-4 px-6 shadow-md flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center space-x-3">
            <div class="w-9 h-9 rounded-full overflow-hidden bg-white shadow flex items-center justify-center p-0.5 border border-gpm-gold/30">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo GPM" class="w-full h-full object-contain">
            </div>
            <h1 class="font-bold text-sm tracking-wide">Kelola Galeri Kegiatan - Admin Panel</h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-xs bg-gpm-navy hover:bg-gpm-gold hover:text-gpm-blue px-4 py-2 rounded-lg font-semibold transition shadow">
            ← Kembali ke Dashboard
        </a>
    </header>

    <!-- Konten Utama Kelola Galeri -->
    <main class="max-w-6xl mx-auto px-6 py-8 flex-grow w-full">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-black text-gpm-blue">Daftar Foto Galeri</h2>
                <p class="text-xs text-gray-500 mt-1">Kelola dokumentasi foto, ubah judul, atau perbarui keterangan kegiatan jemaat.</p>
            </div>
            <a href="{{ route('admin.gallery.create') }}" class="bg-gpm-gold hover:bg-yellow-400 text-gpm-blue font-bold px-5 py-2.5 rounded-xl text-sm shadow transition flex items-center space-x-2">
                <span>+ Tambah Foto Baru</span>
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 text-sm text-green-700 rounded-xl shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-gray-700 uppercase text-xs">
                            <th class="p-4">Foto</th>
                            <th class="p-4">Judul / Keterangan</th>
                            <th class="p-4">Tanggal Unggah</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($galleries as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 w-28">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="" class="w-20 h-16 object-cover rounded-lg shadow-sm border border-gray-100">
                                </td>
                                <td class="p-4">
                                    <p class="font-bold text-gpm-blue text-base">{{ $item->title }}</p>
                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">{{ Str::limit($item->description, 70) ?: 'Tidak ada keterangan tambahan.' }}</p>
                                </td>
                                <td class="p-4 text-xs font-semibold text-gray-600">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.gallery.edit', $item->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3.5 py-2 rounded-lg font-semibold transition shadow">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto kegiatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3.5 py-2 rounded-lg font-semibold transition shadow">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-12 text-center text-gray-400 text-sm">
                                    Belum ada foto galeri kegiatan yang diunggah. Silakan klik tombol <b>+ Tambah Foto Baru</b> di atas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer Admin -->
    <footer class="bg-white py-4 text-center text-xs text-gray-500 border-t border-gray-200 mt-8">
        <p>&copy; {{ date('Y') }} Admin Panel GPM Jemaat Seriholo. All Rights Reserved.</p>
    </footer>

</body>
</html>