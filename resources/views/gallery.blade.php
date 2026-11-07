<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kegiatan - Jemaat GPM Seriholo</title>
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
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col justify-between"
      x-data="{ activeImage: null, activeTitle: '' }">

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
    
    <!-- Konten Utama Galeri -->
    <main class="flex-grow max-w-7xl mx-auto px-6 py-12 w-full">
        <div class="text-center mb-12">
            <span class="bg-gpm-gold/20 text-gpm-blue text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-gpm-gold/30" data-aos="fade-down" data-aos-duration="600">
                Dokumentasi & Kegiatan
            </span>
            <h2 class="text-3xl md:text-4xl font-black text-gpm-blue mt-2" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="150">
                Galeri Kegiatan Jemaat
            </h2>
            <p class="text-gray-600 text-sm mt-2 max-w-xl mx-auto" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                Momen kebersamaan, persekutuan, dan pelayanan kasih di GPM Jemaat Seriholo.
            </p>
        </div>

        @if($galleries->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100" data-aos="fade-up">
                <p class="text-gray-400 text-sm">Belum ada foto kegiatan yang diunggah.</p>
            </div>
        @else
            <!-- Grid Foto Elegan dengan Efek Muncul Bergantian -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach($galleries as $index => $item)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 group transition duration-300 transform hover:-translate-y-1"
                         data-aos="fade-up" 
                         data-aos-duration="700" 
                         data-aos-delay="{{ ($index % 3) * 150 }}">
                        
                        <!-- Kotak Foto dengan Event Klik untuk Memperbesar -->
                        <div class="relative overflow-hidden h-60 bg-gray-200 cursor-pointer"
                             @click="activeImage = '{{ asset('storage/' . $item->image) }}'; activeTitle = '{{ addslashes($item->title) }}'">
                            
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-500">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end justify-between p-4">
                                <span class="text-xs text-white bg-gpm-gold/90 px-2.5 py-1 rounded font-semibold">{{ $item->created_at->format('d M Y') }}</span>
                                <span class="text-xs text-white bg-black/40 px-2 py-1 rounded backdrop-blur-sm">🔍 Perbesar</span>
                            </div>
                        </div>

                        <div class="p-5">
                            <h3 class="font-bold text-gpm-blue text-lg mb-1 group-hover:text-gpm-gold transition">{{ $item->title }}</h3>
                            @if($item->description)
                                <p class="text-gray-600 text-xs leading-relaxed line-clamp-2">{{ $item->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <!-- MODAL / LIGHTBOX POP-UP FULLSCREEN -->
    <div x-show="activeImage"
         style="display: none;"
         x-transition.opacity
         class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4"
         @click.self="activeImage = null">
        
        <div class="relative max-w-4xl w-full flex flex-col items-center">
            <!-- Tombol Close -->
            <button @click="activeImage = null" 
                    class="absolute -top-12 right-0 text-white bg-white/20 hover:bg-white/35 rounded-full px-4 py-1.5 text-xs font-bold transition flex items-center space-x-1">
                <span>✕ Tutup</span>
            </button>
            
            <!-- Gambar Ukuran Besar -->
            <img :src="activeImage" class="max-h-[80vh] max-w-full rounded-xl shadow-2xl object-contain bg-black border border-white/10">
            
            <!-- Keterangan Judul Foto di Dalam Modal -->
            <p class="text-white text-sm font-semibold mt-4 text-center tracking-wide" x-text="activeTitle"></p>
        </div>
    </div>

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
                &copy; {{ date('Y') }} Hak Cipta KKNT FILKOM UKIM 66 KEL 2..
            </p>
        </div>

        <!-- Bagian Kontak & Sosial Media (Email, WhatsApp, Instagram) -->
        <div class="flex flex-col sm:flex-row items-center justify-center md:justify-end gap-3">
            
           <!-- Email -->
<a href="mailto:GPMSeriholo@gmail.com?subject=Pertanyaan%20atau%20Informasi%20Jemaat%20GPM%20Seriholo" class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 px-3.5 py-2.5 rounded-xl transition border border-white/10 text-xs w-full sm:w-auto justify-center">
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