{{-- FILE: resources/views/livewire/menu-catalog.blade.php --}}
<div x-data="menuCatalog()">

    {{-- ═══════ HERO SECTION ═══════ --}}
    <section class="relative overflow-hidden" style="min-height: 520px;">
        {{-- Background Image --}}
        <div class="absolute inset-0">
            <img src="{{ asset('images/burger_hero.png') }}" alt="Burger Hero"
                 class="w-full h-full object-cover"
                 onerror="this.style.display='none'; this.parentElement.style.background='linear-gradient(135deg, #c2410c 0%, #ea580c 50%, #dc2626 100%)'">
            <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(15,5,0,0.82) 0%, rgba(194,65,12,0.65) 50%, rgba(15,5,0,0.80) 100%);"></div>
        </div>

        {{-- Decorative Blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-10" style="background: radial-gradient(circle, #f97316, transparent); transform: translate(30%, -30%);"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 rounded-full opacity-10" style="background: radial-gradient(circle, #ef4444, transparent); transform: translate(-30%, 30%);"></div>

        {{-- Content --}}
        <div class="relative z-10 max-w-4xl mx-auto px-4 flex flex-col items-center justify-center py-16 md:py-24 text-center">
            {{-- Text --}}
            <div class="text-white">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-5"
                     style="background: rgba(249,115,22,0.25); border: 1px solid rgba(249,115,22,0.5); backdrop-filter: blur(8px);">
                    <span class="w-2 h-2 rounded-full bg-orange-400 animate-pulse"></span>
                    Open Now · Siap Antar
                </div>

                <h1 class="font-poppins font-black mb-3 leading-none"
                    style="font-size: clamp(2.5rem, 7vw, 4.5rem); text-shadow: 0 4px 30px rgba(0,0,0,0.5);">
                    Burger Kebab
                    <span class="block" style="background: linear-gradient(90deg, #fb923c, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        MAN 🔥
                    </span>
                </h1>
                <p class="text-orange-100 text-lg font-medium mb-6 opacity-90">
                    Mantap · Authentic · Nikmat
                </p>

                {{-- Stats --}}
                <div class="flex justify-center lg:justify-start gap-6 mb-6">
                    <div class="text-center">
                        <p class="text-2xl font-black text-orange-400">4.0 ⭐</p>
                        <p class="text-xs text-orange-200">Rating</p>
                    </div>
                    <div class="w-px bg-white/20"></div>
                    <div class="text-center">
                        <p class="text-2xl font-black text-orange-400">Sebentar saja</p>
                        <p class="text-xs text-orange-200">Siap</p>
                    </div>
                </div>

                {{-- CTA --}}
                <a href="#menu-section"
                   onclick="document.getElementById('menu-section').scrollIntoView({behavior:'smooth'}); return false;"
                   class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full font-bold text-white shadow-xl transition-all duration-300 hover:scale-105 active:scale-95"
                   style="background: linear-gradient(135deg, #ea580c, #dc2626); box-shadow: 0 8px 32px rgba(234,88,12,0.5);">
                    🍔 Lihat Menu
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Wave bottom --}}
        <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none" style="height: 50px;">
            <svg viewBox="0 0 1440 50" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-full">
                <path d="M0 50L1440 50L1440 20C1200 50 900 0 720 0C540 0 240 50 0 20L0 50Z" fill="#f9fafb"/>
            </svg>
        </div>
    </section>

    {{-- ═══════ MENU SECTION ═══════ --}}
    <div id="menu-section" class="max-w-7xl mx-auto px-4 py-10" style="background: #f9fafb;">

        {{-- Section Title --}}
        <div class="text-center mb-8">
            <p class="text-orange-500 text-sm font-bold uppercase tracking-widest mb-1">✦ Pilihan Terbaik ✦</p>
            <h2 class="font-poppins font-black text-gray-900" style="font-size: 2rem;">Menu Kami</h2>
            <p class="text-gray-500 mt-2 text-sm">Dibuat segar setiap hari, dijamin bikin ketagihan!</p>
        </div>

        {{-- ═══════ SEARCH BAR ═══════ --}}
        <div class="mb-6 flex justify-center">
            <div class="relative w-full max-w-lg">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" wire:model.live.debounce.300ms="search"
                       placeholder="Cari menu favoritmu..."
                       class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-2xl shadow-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none bg-white text-sm transition-all hover:shadow-lg">
            </div>
        </div>

        {{-- ═══════ CATEGORY PILLS ═══════ --}}
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <button wire:click="resetFilter"
                    class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 shadow-sm"
                    style="{{ !$selectedCategory ? 'background: linear-gradient(135deg, #ea580c, #dc2626); color: white; box-shadow: 0 4px 15px rgba(234,88,12,0.4);' : 'background: white; color: #374151; border: 2px solid #e5e7eb;' }}">
                🍽️ Semua
            </button>
            @foreach($categories as $cat)
                @php
                    $catEmoji = match(strtolower($cat->slug ?? $cat->name)) {
                        'burger', 'burgers' => '🍔',
                        'kebab', 'kebabs' => '🥙',
                        'sides', 'side', 'snack', 'snacks' => '🍟',
                        'drinks', 'drink', 'minuman' => '🥤',
                        default => '🍽️'
                    };
                @endphp
                <button wire:click="filterByCategory({{ $cat->id }})"
                        class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 shadow-sm"
                        style="{{ $selectedCategory == $cat->id ? 'background: linear-gradient(135deg, #ea580c, #dc2626); color: white; box-shadow: 0 4px 15px rgba(234,88,12,0.4);' : 'background: white; color: #374151; border: 2px solid #e5e7eb;' }}">
                    {{ $catEmoji }} {{ $cat->name }}
                </button>
            @endforeach
        </div>

        {{-- ═══════ MENU GRID ═══════ --}}
        @if($menus->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($menus as $index => $menu)
                    @php
                        $menuEmoji = match(strtolower($menu->category->slug ?? $menu->category->name ?? '')) {
                            'burger', 'burgers' => '🍔',
                            'kebab', 'kebabs' => '🥙',
                            'sides', 'side', 'snack', 'snacks' => '🍟',
                            'drinks', 'drink', 'minuman' => '🥤',
                            default => '🍔'
                        };
                        $defaultImages = [
                            'burger' => 'images/burger_hero.png',
                            'burgers' => 'images/burger_hero.png',
                            'kebab' => 'images/kebab_menu.png',
                            'kebabs' => 'images/kebab_menu.png',
                            'drinks' => 'images/drinks_menu.png',
                            'drink' => 'images/drinks_menu.png',
                            'minuman' => 'images/drinks_menu.png',
                            'sides' => 'images/sides_menu.png',
                            'side' => 'images/sides_menu.png',
                            'snack' => 'images/sides_menu.png',
                            'snacks' => 'images/sides_menu.png',
                        ];
                        $defaultImg = $defaultImages[strtolower($menu->category->slug ?? $menu->category->name ?? '')] ?? 'images/burger_hero.png';
                    @endphp
                    <div class="group bg-white rounded-3xl shadow-sm overflow-hidden transition-all duration-400 hover:-translate-y-2 border border-gray-100"
                         style="animation: fadeInUp 0.5s ease-out {{ $index * 0.07 }}s both; box-shadow: 0 2px 15px rgba(0,0,0,0.06);"
                         onmouseover="this.style.boxShadow='0 20px 50px rgba(0,0,0,0.15)'"
                         onmouseout="this.style.boxShadow='0 2px 15px rgba(0,0,0,0.06)'">

                        {{-- Image --}}
                        <div class="relative overflow-hidden" style="height: 210px;">
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <img src="{{ asset($defaultImg) }}" alt="{{ $menu->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                     onerror="this.style.display='none'; this.parentElement.style.background='linear-gradient(135deg, #fed7aa, #fdba74)';">
                            @endif

                            {{-- Gradient Overlay --}}
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                 style="background: linear-gradient(to top, rgba(194,65,12,0.5) 0%, transparent 60%);"></div>

                            {{-- Best Seller Badge --}}
                            @if($menu->is_featured)
                                <div class="absolute top-3 left-3">
                                    <span class="text-white text-xs font-black px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1"
                                          style="background: linear-gradient(135deg, #f59e0b, #ea580c); box-shadow: 0 4px 12px rgba(245,158,11,0.5);">
                                        🔥 Best Seller
                                    </span>
                                </div>
                            @endif

                            {{-- Category Badge --}}
                            <div class="absolute top-3 right-3">
                                <span class="text-orange-600 text-xs font-bold px-3 py-1 rounded-full shadow-sm"
                                      style="background: rgba(255,255,255,0.92); backdrop-filter: blur(8px);">
                                    {{ $menuEmoji }} {{ $menu->category->name }}
                                </span>
                            </div>

                            {{-- Hover Add Button Overlay --}}
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <button @click="openModal({{ $menu->id }}, '{{ addslashes($menu->name) }}', {{ $menu->base_price }})"
                                        class="flex items-center gap-2 text-white font-bold px-5 py-2.5 rounded-full shadow-xl transition-all active:scale-95 translate-y-2 group-hover:translate-y-0 duration-300"
                                        style="background: linear-gradient(135deg, #ea580c, #dc2626); box-shadow: 0 8px 24px rgba(220,38,38,0.5);">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-5">
                            <h3 class="font-poppins font-bold text-gray-900 text-lg leading-tight group-hover:text-orange-600 transition-colors duration-200">
                                {{ $menu->name }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1.5 line-clamp-2 leading-relaxed" style="min-height: 2.5rem;">
                                {{ $menu->description ?: 'Dibuat dengan bahan segar berkualitas tinggi, dijamin lezat!' }}
                            </p>

                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    <p class="text-xs text-gray-400 font-medium">Mulai dari</p>
                                    <span class="text-xl font-black font-poppins" style="color: #ea580c;">
                                        Rp {{ number_format($menu->base_price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <button @click="openModal({{ $menu->id }}, '{{ addslashes($menu->name) }}', {{ $menu->base_price }})"
                                        class="w-11 h-11 rounded-2xl flex items-center justify-center text-white text-xl font-bold transition-all duration-200 shadow-md hover:scale-110 active:scale-95"
                                        style="background: linear-gradient(135deg, #ea580c, #dc2626); box-shadow: 0 4px 15px rgba(234,88,12,0.4);">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- ═══════ EMPTY STATE ═══════ --}}
        @if($menus->isEmpty())
            <div class="text-center py-20">
                <div class="text-7xl mb-4" style="animation: bounce 1s infinite;">🔍</div>
                <h3 class="text-xl font-poppins font-bold text-gray-700 mb-2">Menu Tidak Ditemukan</h3>
                <p class="text-gray-500">Coba kata kunci lain atau lihat semua menu kami.</p>
                <button wire:click="resetFilter" class="mt-5 px-6 py-3 text-white rounded-full font-bold transition shadow-md hover:scale-105"
                        style="background: linear-gradient(135deg, #ea580c, #dc2626);">
                    Lihat Semua Menu
                </button>
            </div>
        @endif
    </div>

    {{-- ═══════ MODAL CUSTOMIZATION (ALPINE JS) ═══════ --}}
    <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4"
         style="background: rgba(0,0,0,0.7); backdrop-filter: blur(6px);">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md mx-auto max-h-[88vh] overflow-y-auto hide-scrollbar"
             @click.outside="closeModal()"
             x-show="modalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">

            {{-- Modal Header --}}
            <div class="sticky top-0 z-10 rounded-t-3xl border-b border-gray-100 px-6 py-4"
                 style="background: rgba(255,255,255,0.97); backdrop-filter: blur(12px);">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-orange-500 font-bold uppercase tracking-wider">Kustomisasi Pesanan</p>
                        <h2 class="text-lg font-poppins font-black text-gray-900 mt-0.5" x-text="currentName">Customize</h2>
                    </div>
                    <button @click="closeModal()" class="w-9 h-9 rounded-full bg-gray-100 hover:bg-red-50 hover:text-red-500 flex items-center justify-center transition-all duration-200">
                        <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-5 space-y-5">
                {{-- Spice Level --}}
                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2.5">🌶️ Level Kepedasan</label>
                    <div class="grid grid-cols-5 gap-2">
                        @php $spiceLevels = \App\Models\SpiceLevel::all(); @endphp
                        @foreach($spiceLevels as $spice)
                            <button @click="selectSpice({{ $spice->id }}, '{{ addslashes($spice->name) }}')"
                                    :class="selectedSpice.id === {{ $spice->id }} ? 'border-orange-500 bg-orange-50 text-orange-600 shadow-md' : 'border-gray-200 text-gray-600 hover:border-orange-300'"
                                    class="px-2 py-2.5 rounded-xl border-2 text-xs font-semibold transition-all duration-200 text-center">
                                {{ $spice->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Toppings --}}
                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2.5">🧀 Topping Tambahan</label>
                    <div class="space-y-2">
                        @php $allToppings = \App\Models\Topping::all(); @endphp
                        @foreach($allToppings as $topping)
                            <label class="flex items-center justify-between p-3.5 rounded-2xl border-2 border-gray-100 cursor-pointer hover:border-orange-400 hover:bg-orange-50/50 transition-all duration-200 group">
                                <div class="flex items-center gap-2.5">
                                    <input type="checkbox" value="{{ $topping->id }}"
                                           @change="toggleTopping({{ $topping->id }}, '{{ addslashes($topping->name) }}', {{ $topping->price }}, $event.target.checked)"
                                           class="w-4 h-4 rounded border-gray-300 text-orange-500 focus:ring-orange-500 topping-checkbox-reset">
                                    <span class="text-sm font-semibold text-gray-700 group-hover:text-gray-900">{{ $topping->name }}</span>
                                </div>
                                <span class="text-sm font-black text-orange-500">+Rp {{ number_format($topping->price, 0, ',', '.') }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Qty --}}
                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2.5">📦 Jumlah</label>
                    <div class="flex items-center gap-4">
                        <button @click="changeQty(-1)" class="w-11 h-11 rounded-2xl bg-gray-100 hover:bg-gray-200 text-xl font-black flex items-center justify-center transition-all active:scale-90">
                            −
                        </button>
                        <span x-text="qty" class="text-2xl font-black w-12 text-center font-poppins text-gray-800">1</span>
                        <button @click="changeQty(1)" class="w-11 h-11 rounded-2xl text-white text-xl font-black flex items-center justify-center transition-all active:scale-90"
                                style="background: linear-gradient(135deg, #ea580c, #dc2626);">
                            +
                        </button>
                    </div>
                </div>

                {{-- Notes --}}
                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2.5">📝 Catatan Tambahan</label>
                    <input type="text" x-model="notes" placeholder="Contoh: tanpa bawang, extra saus..."
                           class="w-full px-4 py-3 border-2 border-gray-100 rounded-2xl text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="sticky bottom-0 rounded-b-3xl border-t border-gray-100 px-6 py-4"
                 style="background: rgba(255,255,255,0.97); backdrop-filter: blur(12px);">
                {{-- Total --}}
                <div class="flex justify-between items-center mb-4 p-3 rounded-2xl" style="background: linear-gradient(135deg, #fff7ed, #fef3c7);">
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Total Harga</p>
                        <span x-text="formattedTotal()" class="text-xl font-black font-poppins text-orange-600">Rp 0</span>
                    </div>
                    <div class="text-3xl">🛒</div>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3">
                    <button @click="closeModal()" class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-2xl text-sm font-bold hover:bg-gray-200 transition-all duration-200">
                        Batal
                    </button>
                    <button @click="confirmAdd()" class="flex-2 px-6 py-3 text-white rounded-2xl text-sm font-black transition-all duration-200 shadow-lg hover:scale-105 active:scale-95"
                            style="flex: 2; background: linear-gradient(135deg, #ea580c, #dc2626); box-shadow: 0 6px 20px rgba(234,88,12,0.4);">
                        🛒 Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .transition-all { transition-property: all; }
        .duration-400 { transition-duration: 400ms; }
    </style>

    <script>
        const initMenuCatalog = () => {
            if (!window.Alpine) return;
            window.Alpine.data('menuCatalog', () => ({
                modalOpen: false,
                currentMenuId: null,
                currentName: '',
                currentPrice: 0,

                qty: 1,
                selectedSpice: { id: 1, name: 'Tidak Pedas' },
                selectedToppings: [],
                notes: '',

                openModal(id, name, price) {
                    this.currentMenuId = id;
                    this.currentName = name;
                    this.currentPrice = price;
                    this.qty = 1;
                    this.selectedSpice = { id: 1, name: 'Tidak Pedas' };
                    this.selectedToppings = [];
                    this.notes = '';

                    document.querySelectorAll('.topping-checkbox-reset').forEach(cb => {
                        cb.checked = false;
                    });

                    this.modalOpen = true;
                    document.body.style.overflow = 'hidden';
                },

                closeModal() {
                    this.modalOpen = false;
                    document.body.style.overflow = '';
                },

                selectSpice(id, name) {
                    this.selectedSpice = { id, name };
                },

                toggleTopping(id, name, price, isChecked) {
                    if (isChecked) {
                        this.selectedToppings.push({ id, name, price });
                    } else {
                        this.selectedToppings = this.selectedToppings.filter(t => t.id !== id);
                    }
                },

                changeQty(delta) {
                    this.qty = Math.max(1, Math.min(10, this.qty + delta));
                },

                get total() {
                    let toppingTotal = this.selectedToppings.reduce((sum, t) => sum + t.price, 0);
                    return (this.currentPrice + toppingTotal) * this.qty;
                },

                formattedTotal() {
                    return 'Rp ' + this.total.toLocaleString('id-ID');
                },

                confirmAdd() {
                    Livewire.dispatch('addToCartCustom', {
                        menuId: this.currentMenuId,
                        name: this.currentName,
                        price: this.currentPrice,
                        qty: this.qty,
                        spiceLevel: this.selectedSpice,
                        toppings: this.selectedToppings,
                        notes: this.notes
                    });

                    this.closeModal();

                    if (typeof window.toast === 'function') {
                        window.toast(this.currentName + ' ditambahkan ke keranjang! 🎉', 'success');
                    }
                }
            }));
        };

        document.addEventListener('alpine:init', initMenuCatalog);
        if (window.Alpine) {
            initMenuCatalog();
        }
    </script>
</div>