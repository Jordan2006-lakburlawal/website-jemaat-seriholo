<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Jemaat GPM Seriholo</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gpm: { blue: '#0F2C59', gold: '#D4AF37', navy: '#1E3E62' }
                    },
                    keyframes: {
                        zoomOut: {
                            '0%': { transform: 'scale(1.15)' },
                            '100%': { transform: 'scale(1.0)' },
                        },
                        // Efek Drop & Bounce yang lebih dinamis dan hidup untuk Card Login
                        dropBounce: {
                            '0%': { opacity: '0', transform: 'translateY(-60px) scale(0.9)' },
                            '60%': { opacity: '1', transform: 'translateY(15px) scale(1.02)' },
                            '80%': { transform: 'translateY(-8px) scale(0.99)' },
                            '100%': { opacity: '1', transform: 'translateY(0) scale(1)' },
                        }
                    },
                    animation: {
                        'zoom-out': 'zoomOut 6s ease-out forwards',
                        'drop-bounce': 'dropBounce 0.9s cubic-bezier(0.25, 1, 0.5, 1) forwards',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gpm-blue min-h-screen flex items-center justify-center px-6 relative overflow-hidden"
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
            <img :src="slide" alt="Background Gereja" class="w-full h-full object-cover object-center animate-zoom-out">
            <div class="absolute inset-0 bg-gpm-blue/60 backdrop-blur-sm"></div>
        </div>
    </template>

    <!-- Card Form Login dengan Animasi Drop & Bounce yang Dinamis -->
    <div class="max-w-md w-full bg-white/85 backdrop-blur-md rounded-3xl shadow-2xl p-8 border border-white/50 relative z-10 animate-drop-bounce">
        <div class="text-center mb-8">
            <div class="w-24 h-24 mx-auto flex items-center justify-center shadow-2xl border-4 border-white/20 rounded-full overflow-hidden bg-white/10 backdrop-blur animate-bounce">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo GPM" class="w-full h-full object-contain">
            </div>
            <h2 class="text-2xl font-black text-gpm-blue">Admin Panel Login</h2>
            <p class="text-xs text-gray-600 mt-1">Jemaat GPM Seriholo</p>
        </div>

        @if($errors->any())
            <div class="mb-4 bg-red-50/90 border-l-4 border-red-500 p-3 text-sm text-red-700 rounded-lg shadow-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Username</label>
                <input type="text" name="username" required class="w-full px-4 py-3 rounded-xl border border-gray-300/80 bg-white/75 focus:ring-2 focus:ring-gpm-blue focus:outline-none text-sm transition" placeholder="Masukkan username">
            </div>

            <!-- Input Password dengan Fitur Toggle Ikon Mata -->
            <div x-data="{ showPassword: false }">
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Password</label>
                <div class="relative">
                    <input :type="showPassword ? 'text' : 'password'" name="password" required class="w-full pl-4 pr-12 py-3 rounded-xl border border-gray-300/80 bg-white/75 focus:ring-2 focus:ring-gpm-blue focus:outline-none text-sm transition" placeholder="Masukkan password">
                    
                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gpm-blue focus:outline-none transition">
                        <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-gpm-blue hover:bg-gpm-navy text-white font-bold py-3.5 rounded-xl shadow-lg transition duration-300 text-sm tracking-wide">
                Masuk ke Dashboard
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('admin.logout.home') }}" class="text-xs text-gray-600 hover:text-gpm-blue transition font-semibold">
                ← Kembali ke Halaman Utama
            </a>
        </div>
    </div>

</body>
</html>