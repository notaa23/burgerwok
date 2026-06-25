{{-- FILE: resources/views/livewire/menu-catalog.blade.php --}}
<div x-data="menuCatalog()">
    {{-- ═══════ HERO SECTION ═══════ --}}
    <section class="relative bg-gradient-to-br from-orange-500 via-orange-600 to-red-600 py-16 md:py-24 overflow-hidden">
        {{-- Decorative circles --}}
        <div class="absolute top-0 left-0 w-72 h-72 bg-white/10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full translate-x-1/3 translate-y-1/3"></div>

        <div class="relative max-w-7xl mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-poppins font-bold mb-4 drop-shadow-lg">
                Burger Kebab MAN
            </h1>
            <p class="text-lg md:text-xl font-medium text-orange-100 tracking-wide">
                Mantap • Authentic • Nikmat
            </p>
            <div class="flex justify-center mt-4">
                <div class="flex items-center gap-1 text-yellow-300 text-sm">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <span class="ml-1">Rasa Terjamin!</span>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-8">
        {{-- ═══════ SEARCH BAR ═══════ --}}
        <div class="mb-6 flex justify-center">
            <div class="relative w-full max-w-lg">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" wire:model.live.debounce.300ms="search"
                       placeholder="Cari menu favoritmu..."
                       class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-full shadow-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none bg-white text-sm transition-shadow hover:shadow-lg">
            </div>
        </div>

        {{-- ═══════ CATEGORY PILLS ═══════ --}}
        <div class="flex flex-wrap justify-center gap-2 mb-8 hide-scrollbar">
            <button wire:click="resetFilter"
                    class="px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200 shadow-sm
                           {{ !$selectedCategory ? 'bg-orange-500 text-white shadow-orange-200' : 'bg-white text-gray-700 hover:bg-orange-50 hover:text-orange-600 border border-gray-200' }}">
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
                        class="px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200 shadow-sm
                               {{ $selectedCategory == $cat->id ? 'bg-orange-500 text-white shadow-orange-200' : 'bg-white text-gray-700 hover:bg-orange-50 hover:text-orange-600 border border-gray-200' }}">
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
                    @endphp
                    <div class="group bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-xl hover:scale-[1.02] transition-all duration-300 border border-gray-100"
                         style="animation: fadeInUp 0.5s ease-out {{ $index * 0.05 }}s both;">
                        {{-- Image --}}
                        <div class="relative h-48 overflow-hidden">
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center">
                                    <span class="text-6xl group-hover:scale-110 transition-transform duration-300">{{ $menuEmoji }}</span>
                                </div>
                            @endif

                            {{-- Best Seller Badge --}}
                            @if($menu->is_featured)
                                <div class="absolute top-3 left-3">
                                    <span class="bg-gradient-to-r from-yellow-400 to-orange-400 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md flex items-center gap-1">
                                        🔥 Best Seller
                                    </span>
                                </div>
                            @endif

                            {{-- Category Badge --}}
                            <div class="absolute top-3 right-3">
                                <span class="bg-white/90 backdrop-blur-sm text-orange-600 text-xs font-semibold px-2.5 py-1 rounded-full shadow-sm">
                                    {{ $menu->category->name }}
                                </span>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-4">
                            <h3 class="font-poppins font-bold text-lg text-gray-800 group-hover:text-orange-600 transition-colors">
                                {{ $menu->name }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1 line-clamp-2 leading-relaxed">
                                {{ $menu->description }}
                            </p>
                            <div class="flex items-center justify-between mt-4">
                                <span class="text-xl font-bold text-orange-500 font-poppins">
                                    Rp {{ number_format($menu->base_price, 0, ',', '.') }}
                                </span>
                                <button @click="openModal({{ $menu->id }}, '{{ addslashes($menu->name) }}', {{ $menu->base_price }})"
                                        class="bg-orange-500 hover:bg-orange-600 text-white w-10 h-10 rounded-full flex items-center justify-center text-xl font-bold transition-all duration-200 shadow-md hover:shadow-lg hover:scale-110 active:scale-95">
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
                <div class="text-7xl mb-4 animate-bounce-slow">🔍</div>
                <h3 class="text-xl font-poppins font-bold text-gray-700 mb-2">Menu Tidak Ditemukan</h3>
                <p class="text-gray-500">Coba kata kunci lain atau lihat semua menu kami.</p>
                <button wire:click="resetFilter" class="mt-4 px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-full font-semibold transition shadow-md">
                    Lihat Semua Menu
                </button>
            </div>
        @endif
    </div>

    {{-- ═══════ MODAL CUSTOMIZATION (ALPINE JS) ═══════ --}}
    <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto max-h-[85vh] overflow-y-auto hide-scrollbar"
             @click.outside="closeModal()"
             x-show="modalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

            {{-- Modal Header --}}
            <div class="sticky top-0 bg-white/95 backdrop-blur-sm border-b border-gray-100 px-6 py-4 rounded-t-2xl z-10">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-poppins font-bold text-gray-800" x-text="currentName">Customize</h2>
                    <button @click="closeModal()" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition">
                        <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 space-y-5">
                {{-- Spice Level --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">🌶️ Level Kepedasan</label>
                    <div class="grid grid-cols-5 gap-2">
                        @php
                            $spiceLevels = \App\Models\SpiceLevel::all();
                        @endphp
                        @foreach($spiceLevels as $spice)
                            <button @click="selectSpice({{ $spice->id }}, '{{ addslashes($spice->name) }}')"
                                    :class="selectedSpice.id === {{ $spice->id }} ? 'border-orange-500 bg-orange-50 text-orange-600' : 'border-gray-200 text-gray-700'"
                                    class="px-2 py-2.5 rounded-xl border-2 text-xs font-medium hover:border-orange-300 transition-all duration-200 text-center">
                                {{ $spice->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Toppings --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">🧀 Topping Tambahan</label>
                    <div class="space-y-2">
                        @php
                            $allToppings = \App\Models\Topping::all();
                        @endphp
                        @foreach($allToppings as $topping)
                            <label class="flex items-center justify-between p-3 rounded-xl border-2 border-gray-100 cursor-pointer hover:border-orange-300 hover:bg-orange-50/50 transition-all duration-200 group">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" value="{{ $topping->id }}"
                                           @change="toggleTopping({{ $topping->id }}, '{{ addslashes($topping->name) }}', {{ $topping->price }}, $event.target.checked)"
                                           class="w-4 h-4 rounded border-gray-300 text-orange-500 focus:ring-orange-500 topping-checkbox-reset">
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">{{ $topping->name }}</span>
                                </div>
                                <span class="text-sm font-semibold text-orange-500">+Rp {{ number_format($topping->price, 0, ',', '.') }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Qty --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">📦 Jumlah</label>
                    <div class="flex items-center gap-4">
                        <button @click="changeQty(-1)" class="w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 text-xl font-bold flex items-center justify-center transition active:scale-90">
                            −
                        </button>
                        <span x-text="qty" class="text-2xl font-bold w-10 text-center font-poppins">1</span>
                        <button @click="changeQty(1)" class="w-10 h-10 rounded-full bg-orange-100 hover:bg-orange-200 text-xl font-bold text-orange-600 flex items-center justify-center transition active:scale-90">
                            +
                        </button>
                    </div>
                </div>

                {{-- Notes --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">📝 Catatan</label>
                    <input type="text" x-model="notes" placeholder="Tambahan, tanpa bawang, extra saus..."
                           class="w-full px-4 py-2.5 border-2 border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="sticky bottom-0 bg-white border-t border-gray-100 px-6 py-4 rounded-b-2xl">
                {{-- Total --}}
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm font-medium text-gray-600">Total Harga</span>
                    <span x-text="formattedTotal()" class="text-xl font-bold text-orange-500 font-poppins">Rp 0</span>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3">
                    <button @click="closeModal()" class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-200 transition">
                        Batal
                    </button>
                    <button @click="confirmAdd()" class="flex-1 px-4 py-2.5 bg-orange-500 text-white rounded-xl text-sm font-bold hover:bg-orange-600 transition shadow-md hover:shadow-lg active:scale-95">
                        🛒 Tambah
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('menuCatalog', () => ({
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
                    
                    // Uncheck all toppings
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
                    // Send to Livewire component
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
                        window.toast(this.currentName + ' ditambahkan ke keranjang!', 'success');
                    }
                }
            }));
        });
    </script>
</div>