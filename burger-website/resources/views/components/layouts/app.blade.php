{{-- FILE: resources/views/components/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Burger Kebab MAN - Mantap, Authentic, Nikmat. Pesan burger dan kebab terbaik secara online.">
    <title>{{ $title ?? 'Burger Kebab MAN' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                        inter: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'bounce-slow': 'bounce 2s infinite',
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">

    {{-- ═══════ NAVBAR ═══════ --}}
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-md group-hover:shadow-lg group-hover:bg-orange-600 transition-all duration-300">
                        M
                    </div>
                    <div>
                        <h1 class="font-poppins font-bold text-lg leading-tight text-gray-800">Burger Kebab</h1>
                        <p class="text-orange-500 font-bold text-xs tracking-wider">MAN</p>
                    </div>
                </a>

                {{-- Desktop Nav Links --}}
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" wire:navigate class="text-sm font-medium text-gray-600 hover:text-orange-500 transition-colors duration-200 relative group">
                        Menu
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('order-status') }}" wire:navigate class="text-sm font-medium text-gray-600 hover:text-orange-500 transition-colors duration-200 relative group">
                        Cek Pesanan
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <livewire:cart-counter />
                </div>
            </div>
        </div>
    </nav>

    {{-- ═══════ MAIN CONTENT ═══════ --}}
    <main class="flex-1 pb-20 md:pb-0">
        {{ $slot }}
    </main>

    {{-- ═══════ FOOTER ═══════ --}}
    <footer class="bg-gray-900 text-white py-12 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Brand --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-white font-bold text-xl">M</div>
                        <div>
                            <h3 class="font-poppins font-bold text-lg">Burger Kebab</h3>
                            <p class="text-orange-400 text-xs font-bold tracking-wider">MAN</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">Mantap • Authentic • Nikmat. Burger dan kebab dengan cita rasa otentik pilihan terbaik.</p>
                </div>

                {{-- Jam Operasional --}}
                <div>
                    <h4 class="font-poppins font-semibold text-lg mb-4">Jam Operasional</h4>
                    <div class="flex items-center gap-3 text-gray-400">
                        <svg class="w-5 h-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm">Setiap Hari</p>
                            <p class="text-white font-semibold">15:00 - 23:00 WIB</p>
                        </div>
                    </div>
                </div>

                {{-- Kontak --}}
                <div>
                    <h4 class="font-poppins font-semibold text-lg mb-4">Kontak Kami</h4>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            </svg>
                            <p class="text-sm">0812-XXX-XXXX</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Burger Kebab MAN. All rights reserved.
            </div>
        </div>
    </footer>

    {{-- ═══════ FLOATING WHATSAPP ═══════ --}}
    <a href="https://wa.me/62812XXXXXXXX" target="_blank"
       class="hidden md:flex fixed bottom-6 right-6 z-40 bg-green-500 hover:bg-green-600 text-white rounded-full w-14 h-14 items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 animate-bounce-slow">
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
        </svg>
    </a>

    {{-- ═══════ BACK TO TOP ═══════ --}}
    <div x-data="{ showTop: false }" @scroll.window="showTop = (window.pageYOffset > 300)">
        <button x-show="showTop"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-4"
                @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                class="hidden md:flex fixed bottom-6 left-6 z-40 bg-orange-500 hover:bg-orange-600 text-white rounded-full w-12 h-12 items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
            </svg>
        </button>
    </div>

    {{-- ═══════ MOBILE BOTTOM NAV ═══════ --}}
    <nav class="md:hidden fixed bottom-0 inset-x-0 z-50 bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
        <div class="grid grid-cols-4 h-16">
            <a href="/" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-orange-500 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-[10px] mt-0.5 font-medium">Home</span>
            </a>
            <a href="/" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-orange-500 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                <span class="text-[10px] mt-0.5 font-medium">Menu</span>
            </a>
            <a href="/cart" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-orange-500 transition-colors relative">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
                <span class="text-[10px] mt-0.5 font-medium">Keranjang</span>
            </a>
            <a href="/order-status" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-orange-500 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                <span class="text-[10px] mt-0.5 font-medium">Pesanan</span>
            </a>
        </div>
    </nav>

    {{-- ═══════ TOAST CONTAINER ═══════ --}}
    <div class="fixed top-20 right-4 z-[60]" id="toast-container">
        <x-toast />
    </div>

    @livewireScripts
</body>
</html>