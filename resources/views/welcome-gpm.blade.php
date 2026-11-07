<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - JEMAAT GPM SERIHOLO</title>
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
                    },
                    keyframes: {
                        zoomOut: {
                            '0%': { transform: 'scale(1.15)' },
                            '100%': { transform: 'scale(1.0)' },
                        }
                    },
                    animation: {
                        'zoom-out': 'zoomOut 6s ease-out forwards',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gpm-blue text-white font-sans antialiased min-h-screen flex flex-col justify-between relative overflow-hidden"
      x-data="{
          activeSlide: 0,
          slides: [
              '{{ asset('images/bg-1.jpeg') }}',
              '{{ asset('images/bg-2.jpeg') }}',
              '{{ asset('images/bg-3.jpeg') }}'
          ],
          init() {
              setInterval(() => {
                  this.activeSlide = (this.activeSlide + 1) % this.slides.length;
              }, 5000);
          }
      }">

    <!-- Background Slider dengan Efek Animasi Zoom Out & Fade -->
    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="activeSlide === index"
             x-transition:enter="transition-opacity duration-1000 ease-in-out"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity duration-1000 ease-in-out"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 z-0 bg-gpm-blue overflow-hidden">
            <!-- Gambar dengan efek animasi zoom out perlahan -->
            <img :src="slide" alt="Background Gereja" class="w-full h-full object-cover object-center animate-zoom-out">
            <!-- Overlay Biru GPM agar teks tetap sangat jelas terbaca -->
            <div class="absolute inset-0 bg-gpm-blue/55 backdrop-brightness-90"></div>
        </div>
    </template>

    <!-- Header / Navigasi Atas -->
    <header class="w-full py-6 px-8 flex justify-between items-center max-w-7xl mx-auto relative z-10" data-aos="fade-down" data-aos-duration="800">
        <div class="flex items-center space-x-3">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo GPM" class="w-10 h-10 object-contain rounded-full shadow bg-white p-0.5">
                <div>
                    <h1 class="text-sm font-bold tracking-wider">JEMAAT GPM SERIHOLO</h1>
                    <p class="text-[10px] text-gray-200">Gereja Protestan Maluku</p>
                </div>
            </div>
        </div>
        <div></div>
    </header>

    <!-- Konten Utama Landing Page -->
    <main class="flex-grow flex items-center justify-center px-6 py-12 relative z-10">
        <div class="max-w-3xl mx-auto text-center space-y-6">
            
            <!-- Logo Besar di Tengah dengan Animasi Zoom -->
            <div class="w-24 h-24 mx-auto flex items-center justify-center shadow-2xl border-4 border-white/20 rounded-full overflow-hidden bg-white/10 backdrop-blur animate-bounce">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo GPM" class="w-full h-full object-contain p-1">
            </div>

            <!-- Badge & Judul Utama dengan Animasi Fade Up Berjenjang -->
            <div class="space-y-2">
                <span class="inline-block bg-gpm-gold/20 text-gpm-gold text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-gpm-gold/30" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                    Situs Resmi Jemaat
                </span>
                <h2 class="text-4xl md:text-6xl font-black tracking-tight text-white drop-shadow-md" data-aos="fade-up" data-aos-duration="800" data-aos-delay="350">
                    Selamat Datang di <br><span class="text-gpm-gold">Jemaat GPM Seriholo</span>
                </h2>
            </div>

            <!-- Ayat Alkitab dengan Animasi Fade -->
            <p class="text-gray-100 text-base md:text-lg italic max-w-2xl mx-auto leading-relaxed drop-shadow" data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
                "Aku Menanam, Apolos Menyiram, Tetapi Allah yang Menumbuhkan" <br>
                <span class="text-xs text-gpm-gold font-semibold not-italic tracking-wider uppercase">— 1 Korintus 3:6 —</span>
            </p>

            <!-- Tombol Navigasi dengan Efek Muncul dari Bawah -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="650">
                <a href="{{ route('profile') }}" class="w-full sm:w-auto bg-gpm-gold hover:bg-yellow-400 text-gpm-blue font-bold px-8 py-3.5 rounded-xl shadow-lg transition duration-300 transform hover:-translate-y-0.5 text-center">
                    Lihat Profil Jemaat →
                </a>
            </div>

        </div>
    </main>

    <!-- Footer Landing Page -->
    <footer class="py-6 text-center text-xs text-gray-300 border-t border-white/10 relative z-10" data-aos="fade" data-aos-duration="1000">
        <p>&copy; {{ date('Y') }} Gereja Protestan Maluku - Jemaat Seriholo. All Rights Reserved.</p>
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