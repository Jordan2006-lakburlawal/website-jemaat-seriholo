<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Ibadah Jemaat - Jemaat GPM Seriholo</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- AOS CSS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col justify-between">

     <!-- Header / Navbar -->
    <header class="bg-gpm-blue text-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo GPM" class="w-10 h-10 object-contain rounded-full shadow bg-white p-0.5">
                    <div>
                        <h1 class="text-sm font-bold tracking-wider text-white">JEMAAT GPM SERIHOLO</h1>
                        <p class="text-[10px] text-gray-200">Gereja Protestan Maluku</p>
                    </div>
                </div>
            </div>

           <!-- Menu Dropdown Titik Tiga -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 rounded-lg hover:bg-gpm-navy text-white focus:outline-none transition flex items-center space-x-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
                <div x-show="open" 
                     @click.away="open = false" 
                     x-transition 
                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 text-gray-800 border border-gray-100 z-50">
                    <a href="{{ route('welcome') }}" class="block px-4 py-2 text-sm font-bold text-gpm-blue hover:bg-gray-100 transition">Halaman Depan</a>
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 transition">Profil Jemaat</a>
                    <a href="{{ route('jadwal.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 transition">Jadwal Ibadah</a>
                    <a href="{{ route('gallery.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 transition">Galeri Kegiatan</a>
                    <div class="border-t my-1"></div>
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm font-semibold text-gpm-blue hover:bg-gpm-gold hover:text-gpm-blue transition">
                        Admin Panel
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-grow max-w-7xl mx-auto px-6 py-12 w-full">
        <div class="text-center mb-12">
            <span class="bg-gpm-gold/20 text-gpm-blue text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-gpm-gold/30" data-aos="fade-right" data-aos-duration="600">
                Informasi Jemaat
            </span>
            <h2 class="text-3xl md:text-4xl font-black text-gpm-blue mt-2" data-aos="fade-left" data-aos-duration="800" data-aos-delay="150">
                Jadwal Ibadah Jemaat
            </h2>
            <p class="text-gray-600 text-sm mt-2 max-w-xl mx-auto" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                Informasi pelaksanaan ibadah, pelayan firman, bacaan, serta unduhan liturgi.
            </p>
        </div>

        <!-- Tabel Jadwal Ibadah dengan Efek Zoom-In -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100" data-aos="zoom-in" data-aos-duration="900" data-aos-delay="200">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gpm-blue text-white uppercase text-xs tracking-wider">
                            <th class="p-4">Nama Ibadah</th>
                            <th class="p-4">Waktu</th>
                            <th class="p-4">Tempat</th>
                            <th class="p-4">Pelayan Firman</th>
                            <th class="p-4">Bacaan Firman</th>
                            <th class="p-4 text-center">Liturgi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @if(isset($jadwals) && $jadwals->count() > 0)
                            @foreach($jadwals as $jadwal)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 font-bold text-gpm-blue">{{ $jadwal->nama_ibadah }}</td>
                                    <td class="p-4 text-gray-600">{{ $jadwal->waktu }}</td>
                                    <td class="p-4 text-gray-600">{{ $jadwal->tempat }}</td>
                                    <td class="p-4 text-gray-600">{{ $jadwal->pelayan_firman }}</td>
                                    <td class="p-4 text-gray-600">{{ $jadwal->bacaan_firman }}</td>
                                    <td class="p-4 text-center">
                                        @if(!empty($jadwal->file_liturgi))
                                            <a href="{{ asset($jadwal->file_liturgi) }}" target="_blank" class="bg-gpm-gold text-gpm-blue font-bold text-xs px-3 py-1.5 rounded-lg shadow hover:bg-yellow-400 transition inline-block">
                                                Unduh Liturgi 📄
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400 italic">Tidak ada</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="p-16 text-center text-gray-400 text-sm italic">
                                    Belum ada jadwal ibadah yang tersedia.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>

  <!-- Footer dengan Info Kontak Email, Instagram & WhatsApp yang Dirapikan -->
<footer class="bg-gpm-blue text-white py-10 border-t border-white/10 mt-auto">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        
        <!-- Informasi Gereja & Hak Cipta -->
        <div class="text-center md:text-left space-y-2">
            <div class="flex items-center justify-center md:justify-start space-x-2">
                <div class="w-2 h-2 rounded-full bg-gpm-gold"></div>
                <h3 class="font-black text-sm tracking-wider text-white">JEMAAT GPM SERIHOLO</h3>
            </div>
            <p class="text-xs text-gray-300 leading-relaxed">
                Pusat Pelayanan dan Informasi Jemaat Gereja Protestan Maluku.<br>
                &copy; {{ date('Y') }} Hak Cipta KKNT FILKOM UKIM 66 KEL 2.
            </p>
        </div>

        <!-- Bagian Kontak & Sosial Media (Email, WhatsApp, Instagram) -->
        <div class="flex flex-col sm:flex-row items-center justify-center md:justify-end gap-3">
            
            <!-- Email -->
            <a href="mailto:GPMSeriholo@gmail.com" class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 px-3.5 py-2.5 rounded-xl transition border border-white/10 text-xs w-full sm:w-auto justify-center">
                <svg class="w-4 h-4 text-gpm-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span>Email</span>
            </a>

            <!-- WhatsApp -->
            <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 px-3.5 py-2.5 rounded-xl transition border border-white/10 text-xs w-full sm:w-auto justify-center">
                <svg class="w-4 h-4 fill-current text-green-400" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-2.972-1.49-4.922-2.668-6.892-6.09-.147-.253-.016-.39.109-.515.112-.111.248-.297.372-.446.124-.149.165-.248.248-.412.083-.165.042-.31-.021-.434-.063-.124-.57-1.382-.782-1.89-.207-.502-.419-.434-.579-.442-.15-.008-.323-.008-.496-.008-.173 0-.455.063-.692.31-.237.247-.908.887-.908 2.162 0 1.275.931 2.508 1.06 2.682.129 1.74 3.534 5.385 8.541 7.557 3.393 1.462 4.085 1.17 4.817 1.096.732-.074 2.314-.947 2.642-1.861.328-.914.328-1.691.23-1.861z"/>
                </svg>
                <span>WhatsApp</span>
            </a>

            <!-- Instagram -->
            <a href="https://instagram.com/nama_akun_ig" target="_blank" class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 px-3.5 py-2.5 rounded-xl transition border border-white/10 text-xs w-full sm:w-auto justify-center">
                <svg class="w-4 h-4 fill-current text-gpm-gold" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
                <span>Instagram</span>
            </a>

        </div>
    </div>
</footer>

    <!-- AOS JS Initialization -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
        });
    </script>

</body>
</html>