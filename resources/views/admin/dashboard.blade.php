<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Jemaat GPM Seriholo</title>
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
<body class="bg-gray-100 text-gray-800 font-sans antialiased min-h-screen flex flex-col justify-between"
      x-data="{ activeTab: 'profil' }">

    <!-- Header / Navbar Admin -->
    <header class="bg-gpm-blue text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full overflow-hidden bg-white shadow flex items-center justify-center p-0.5 border border-gpm-gold/30">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo GPM" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-sm font-bold tracking-wider text-white">JEMAAT GPM SERIHOLO</h1>
                    <p class="text-[10px] text-gray-300">Admin Control Panel</p>
                </div>
            </div>

            <div>
                <a href="{{ route('admin.logout.home') }}" class="text-xs bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition shadow flex items-center space-x-1">
                    <span>Keluar ke Halaman Utama</span>
                    <svg class="w-4 h-4 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Konten Utama Dashboard Admin -->
    <main class="flex-grow max-w-7xl mx-auto px-6 py-8 w-full">

        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 text-sm text-green-700 rounded-xl shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Layout Grid: Sidebar di Kiri (1 Kolom) & Konten di Kanan (3 Kolom) -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">
            
            <!-- SIDEBAR NAVIGASI -->
            <div class="md:col-span-1 bg-white rounded-2xl shadow-md p-4 border border-gray-200 space-y-2 sticky top-24">
                <h3 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider px-3 pb-2">Menu Navigasi</h3>
                
                <button @click="activeTab = 'profil'" 
                        :class="activeTab === 'profil' ? 'bg-gpm-blue text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100'"
                        class="w-full text-left px-4 py-3 rounded-xl font-bold text-sm transition flex items-center space-x-2">
                    <span>Kelola Profil Jemaat</span>
                </button>

                <button @click="activeTab = 'jadwal'" 
                        :class="activeTab === 'jadwal' ? 'bg-gpm-blue text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100'"
                        class="w-full text-left px-4 py-3 rounded-xl font-bold text-sm transition flex items-center space-x-2">
                    <span>Kelola Jadwal Ibadah</span>
                </button>

                <a href="{{ route('admin.gallery.index') }}" 
                   class="w-full text-left px-4 py-3 rounded-xl font-bold text-sm text-gray-700 hover:bg-gray-100 transition flex items-center justify-between">
                    <span>Kelola Galeri Foto</span>
                    <span class="text-xs">↗</span>
                </a>
            </div>

            <!-- AREA KONTEN UTAMA -->
            <div class="md:col-span-3 space-y-6">

                <!-- 1. TAB KELOLA PROFIL JEMAAT (LENGKAP DENGAN KEPENGURUSAN) -->
                <div x-show="activeTab === 'profil'" class="bg-white rounded-2xl shadow-md p-8 border border-gray-200 space-y-6">
                    <div>
                        <h2 class="text-xl font-black text-gpm-blue">Pengaturan Profil & Statistik Jemaat</h2>
                        <p class="text-xs text-gray-500 mt-1">Perbarui data statistik, sejarah, serta struktur kepengurusan majelis jemaat.</p>
                    </div>

                    <!-- Form Profil & Kepengurusan -->
                    <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Statistik Utama -->
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 space-y-4">
                            <h3 class="text-xs font-bold text-gpm-blue uppercase tracking-wider">Statistik Jemaat</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Total Jemaat (Jiwa)</label>
                                    <input type="number" name="total_jemaat" value="{{ $profile->total_jemaat ?? 832 }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-gpm-blue focus:outline-none bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Jumlah Sektor</label>
                                    <input type="number" name="total_sektor" value="{{ $profile->total_sektor ?? 3 }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-gpm-blue focus:outline-none bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Jumlah Unit</label>
                                    <input type="number" name="total_unit" value="{{ $profile->total_unit ?? 6 }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-gpm-blue focus:outline-none bg-white">
                                </div>
                            </div>
                        </div>

                        <!-- Sejarah Jemaat -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Sejarah Jemaat</label>
                            <textarea name="sejarah_jemaat" rows="4" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-gpm-blue focus:outline-none">{{ $profile->sejarah_jemaat ?? 'Seriholo adalah...' }}</textarea>
                        </div>

                        <!-- STRUKTUR KEPENGURUSAN MAJELIS JEMAAT (FORM INPUT KEMBALI) -->
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 space-y-4">
                            <h3 class="text-xs font-bold text-gpm-blue uppercase tracking-wider">Struktur Kepengurusan Majelis Jemaat</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Ketua Majelis Jemaat</label>
                                    <input type="text" name="ketua_majelis" value="{{ $profile->ketua_majelis ?? '' }}" placeholder="Nama Ketua Majelis" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-gpm-blue focus:outline-none bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Sekretaris Majelis</label>
                                    <input type="text" name="sekretaris_majelis" value="{{ $profile->sekretaris_majelis ?? '' }}" placeholder="Nama Sekretaris" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-gpm-blue focus:outline-none bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Bendahara Jemaat</label>
                                    <input type="text" name="bendahara_jemaat" value="{{ $profile->bendahara_jemaat ?? '' }}" placeholder="Nama Bendahara" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-gpm-blue focus:outline-none bg-white">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Anggota Majelis / Sektor Terkait</label>
                                <textarea name="anggota_majelis" rows="3" placeholder="Daftar nama anggota majelis..." class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-gpm-blue focus:outline-none bg-white">{{ $profile->anggota_majelis ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="bg-gpm-blue hover:bg-gpm-navy text-white text-xs font-bold px-6 py-3 rounded-xl shadow transition">
                                Simpan Perubahan Profil & Kepengurusan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- 2. TAB KELOLA JADWAL IBADAH -->
                <div x-show="activeTab === 'jadwal'" style="display: none;" class="bg-white rounded-2xl shadow-md p-8 border border-gray-200 space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="text-xl font-black text-gpm-blue">Daftar & Kelola Jadwal Ibadah</h2>
                            <p class="text-xs text-gray-500 mt-1">Atur jadwal pelayan firman, waktu, tempat, serta file liturgi ibadah.</p>
                        </div>
                        <a href="{{ route('admin.jadwal.create') }}" class="bg-gpm-gold hover:bg-yellow-400 text-gpm-blue font-bold px-4 py-2.5 rounded-xl text-xs shadow transition inline-flex items-center space-x-1">
                            <span>+ Tambah Jadwal Baru</span>
                        </a>
                    </div>

                    <!-- Tabel Jadwal Ibadah -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-sm">
                                <thead>
                                    <tr class="bg-gpm-blue text-white uppercase text-xs tracking-wider">
                                        <th class="p-4">Nama Ibadah</th>
                                        <th class="p-4">Waktu</th>
                                        <th class="p-4">Tempat</th>
                                        <th class="p-4">Pelayan</th>
                                        <th class="p-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-sm">
                                    @if(isset($jadwals) && $jadwals->count() > 0)
                                        @foreach($jadwals as $jadwal)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="p-4 font-bold text-gpm-blue">{{ $jadwal->nama_ibadah }}</td>
                                                <td class="p-4 text-gray-600">{{ $jadwal->waktu }}</td>
                                                <td class="p-4 text-gray-600">{{ $jadwal->tempat }}</td>
                                                <td class="p-4 text-gray-600">{{ $jadwal->pelayan_firman }}</td>
                                                <td class="p-4 text-center">
                                                    <div class="flex items-center justify-center space-x-2">
                                                        <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1.5 rounded-lg font-semibold transition shadow">Edit</a>
                                                        <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1.5 rounded-lg font-semibold transition shadow">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="p-12 text-center text-gray-400 text-sm italic">
                                                Belum ada data jadwal ibadah yang ditambahkan.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>

    <!-- Footer Admin -->
    <footer class="bg-white py-4 text-center text-xs text-gray-500 border-t border-gray-200 mt-8">
        <p>&copy; {{ date('Y') }} Admin Panel GPM Jemaat Seriholo. All Rights Reserved.</p>
    </footer>

</body>
</html>